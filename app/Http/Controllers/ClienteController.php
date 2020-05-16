<?php

namespace App\Http\Controllers;

use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;

use App\Entities\Cliente;
use App\Entities\TipoDocumento;
use App\Entities\Municipio;
use App\Entities\Pais;
use App\Entities\Departamento;
use App\Entities\Intermediario;
use App\Entities\Contacto;
use App\Entities\Persona;

class ClienteController extends Controller
{
    public function index() {
        $clientes = Cliente::
            select(
                'cliente.*', 'p.*', 'td.*', 'mu.*',
                'pi.numero_documento as numero_documento_intermediario',
                'pi.telefono as telefono_intermediario', 'pi.celular as celular_intermediario',
                'pi.correo_electronico as correo_electronico_intermediario',
                'mui.indicativo as indicativo_intermediario'
            )
            ->leftjoin('persona as p', 'p.id_persona', 'cliente.id_persona')
            ->leftjoin('tipo_documento as td', 'p.id_tipo_documento', 'td.id_tipo_documento')
            ->leftjoin('municipio as mu', 'mu.id_municipio', 'p.id_municipio')

            ->leftjoin('intermediario as i', 'i.id_intermediario', 'cliente.id_intermediario')
            ->leftjoin('persona as pi', 'pi.id_persona', 'i.id_persona')
            ->leftjoin('municipio as mui', 'mui.id_municipio', 'pi.id_municipio')

            ->where([
            'estado_cliente' => '1',
            'cliente.eliminado' => 0,
        ])->get();

        return $this->renderSection('cliente.listar', [
            'clientes' => $clientes
        ]);
    }


    public function get($id) {

        $cliente = Cliente::
            select(
                'cliente.id_cliente', 'cliente.id_persona', 'cliente.id_intermediario', 'cliente.id_contacto', 'estado_vital_cliente',
                'fecha_fallecimiento', 'nombre_persona_recomienda', 'numero_documento_beneficiario', 'nombre_beneficiario', 'parentesco_beneficiario',
                'estado_cliente', 'cliente.fecha_creacion', 'cliente.eliminado', 'p.id_tipo_documento', 'p.numero_documento', 'p.primer_apellido',
                'p.segundo_apellido', 'p.primer_nombre', 'p.segundo_nombre', 'p.direccion', 'p.barrio', 'p.id_municipio', 'p.celular', 'p.telefono',
                'p.correo_electronico', 'mu.id_departamento', 'de.id_pais', 'mu.indicativo', 'pi.numero_documento as numero_documento_intermediario',
                'pi.telefono as telefono_intermediario', 'pi.celular as celular_intermediario', 'mui.indicativo as indicativo_intermediario', 'cliente.celular2',
                'pi.correo_electronico as correo_electronico_intermediario', 'co.numero_documento as numero_documento_contacto', 'co.nombre_contacto',
                'co.parentesco as parentesco_contacto', 'co.direccion as direccion_contacto', 'co.barrio as barrio_contacto', 'co.celular as celular_contacto',
                'co.telefono as telefono_contacto', 'co.correo_electronico as correo_electronico_contacto', 'co.informacion_adicional', 'co.id_municipio as id_municipio_contacto'
            )
            ->leftjoin('persona as p', 'p.id_persona', 'cliente.id_persona')
            ->leftjoin('tipo_documento as td', 'p.id_tipo_documento', 'td.id_tipo_documento')
            ->leftjoin('municipio as mu', 'mu.id_municipio', 'p.id_municipio')
            ->leftjoin('departamento as de', 'de.id_departamento', 'mu.id_departamento')

            ->leftjoin('intermediario as i', 'i.id_intermediario', 'cliente.id_intermediario')
            ->leftjoin('persona as pi', 'pi.id_persona', 'i.id_persona')
            ->leftjoin('municipio as mui', 'mui.id_municipio', 'pi.id_municipio')

            ->leftjoin('contacto as co', 'co.id_contacto', 'cliente.id_contacto')
            ->leftjoin('municipio as muc', 'muc.id_municipio', 'co.id_municipio')

            ->where('id_cliente', $id)
            ->first();

        $intermediarios = Intermediario::
        leftjoin('persona as p', 'p.id_persona', 'intermediario.id_persona')
        ->where([
            'estado_intermediario' => 1,
            'intermediario.eliminado' => 0,
        ])->get();

        $tiposDocumento = TipoDocumento::where('eliminado', 0)->get();
        $ciudades = Municipio::all();
        $paises = Pais::all();
        $departamentos = Departamento::all();

        $municipios = $cliente ? Municipio::where('id_departamento', $cliente->id_departamento)->get() : [];

        return $this->renderSection('cliente.detalle', [
            'cliente' => $cliente,
            'tiposDocumento' => $tiposDocumento,
            'municipios' => $municipios,
            'ciudades' => $ciudades,
            'paises' => $paises,
            'departamentos' => $departamentos,
            'intermediarios' => $intermediarios,
        ]);
    }

    private function clientExists($id, $numero_documento, $id_tipo_documento) {

        $conditional[] = ['numero_documento', $numero_documento];
        $conditional[] = ['id_tipo_documento', $id_tipo_documento];

        if($id) {
            $conditional[] = ['id_cliente', '<>',  $id];
        }

        return Cliente::
        leftjoin('persona as p', 'p.id_persona', 'cliente.id_persona')
        ->where($conditional)
        ->exists();
    }

    public function upsert(Request $request) {

        $id = $request->get('id_cliente');
        preg_match_all('/([0-9])/', $request->get('numero_documento'), $matches);
        $documento = implode('', $matches[0]);
        if(empty($documento)){
            return response()->json([ 'invalidDocument' => true ]);
        }

        $exists = $this->clientExists($id, $documento, $request->get('id_tipo_documento'));
        if($exists) {
            return response()->json(['clientExists' => true ]);
        }

        $contacto = $this->upsertContacto($request);
        $dataPersona = $request->all();
        $dataPersona['id_contacto'] = $contacto->id_contacto;
        $dataPersona['id_usuario_actualizacion'] = Auth::id();

        if(empty($id)){
            $dataPersona['id_usuario_creacion'] = Auth::id();
        }

        $persona = Persona::updateOrCreate(['id_persona' => $request->get('id_persona')], $dataPersona);
        $dataCliente =  $dataPersona;
        $dataCliente['id_persona'] = $persona->id_persona;

        $saved = Cliente::updateOrCreate(['id_cliente' => $id], $dataCliente);
        return response()->json(['saved' => $saved, $request->all() ]);
    }

    private function upsertContacto(Request $request) {

        $dataContacto['nombre_contacto'] = $request->get('nombre_contacto');
        $dataContacto['parentesco'] = $request->get('parentesco_contacto');
        $dataContacto['direccion'] = $request->get('direccion_contacto');
        $dataContacto['barrio'] = $request->get('barrio_contacto');
        $dataContacto['id_municipio'] = $request->get('id_municipio_contacto');
        $dataContacto['celular'] = $request->get('id_municipio_contacto');
        $dataContacto['telefono'] = $request->get('id_municipio_contacto');
        $dataContacto['correo_electronico'] = $request->get('id_municipio_contacto');
        $dataContacto['informacion_adicional'] = $request->get('otra_informacion_contacto');
        $dataContacto['numero_documento'] = '';

        return Contacto::updateOrCreate(['id_contacto' => $request->get('id_contacto')], $dataContacto);
    }

    public function delete($id) {
        $client = Cliente::find($id);
        $client->update([ 'eliminado' => 1 ]);
        return response()->json([ 'deleted' => true ]);
    }


}

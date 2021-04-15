var areYouSureBool = false

function areYouSure(isConf) {
    // if(allowPrompt){
        if ( $('.validate').hasClass('open') && !localStorage.getItem('cancelhashchange') ) {
            if(isConf && !confirm('¿Está seguro que desea salir sin guardar?')) {
                const [hash, lasthash] = JSON.parse(localStorage.getItem('referrer') || '["#", "#"]')
                location.hash = lasthash
                areYouSureBool = true
                localStorage.setItem('cancelhashchange', true)
                return false;
            }

            areYouSureBool = false
            var confMessage = "E S P E R A !!! Antes de abandonar el sitio, debes guardar los cambios";
            return confMessage;
        }

        localStorage.removeItem('cancelhashchange')
}

function saveReferrer() {
    const [hash] = JSON.parse(localStorage.getItem('referrer') || '["#", "#"]')
    localStorage.setItem('referrer', JSON.stringify([location.hash, hash]))
}

function render() {

  areYouSureBool = false
  let [myURL, paramsString] = location.hash.replace('#', '').toLowerCase().split('?')
  let url = myURL
  const count = url.split('/').filter(section => section.trim()).length
  if(count === 1) {
    url += '/listar'
  }

  if (url) {
    $.ajax({
      url: url + '?' + paramsString + '&url=' + myURL,
      data: new URLSearchParams({}),
      success: data => {

        if(data.redirect || data.redirect === ''){
            location.pathname = '/'
            location.hash = data.redirect
            return false;
        }

        if (data.title) { document.title = data.title }
        $('#main-content').html(data.content || '<div></div>')

        const html = [];
        html.push('<ol class="breadcrumb">');
        data.breadcrumb && data.breadcrumb.map(item => html.push(`<li><a href="${item.link}">${item.name}</a></li>`))
        html.push('</ol>');

        $('#breadcrumb').html(html.join(''))
        if (data.javascript) { $('body').append(data.javascript) }
        compileLibraries()
        compileCurrencyInputs()
      }
    })
  }
}

$(document).ready(function () {
  saveReferrer()
  render()
})

window.onbeforeunload = () => areYouSure(false);

window.addEventListener('hashchange', function () {
    saveReferrer()
    areYouSure(true) !== false && !areYouSureBool && render()
}, false);

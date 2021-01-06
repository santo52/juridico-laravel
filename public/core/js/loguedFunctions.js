function render() {

  let [url, paramsString] = location.hash.replace('#', '').toLowerCase().split('?')
  const count = url.split('/').filter(section => section.trim()).length
  if(count === 1) {
    url += '/listar'
  }

  if (url) {
    $.ajax({
      url: url + '?' + paramsString,
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
      }
    })
  }
}

$(document).ready(function () {
  render()
})

window.addEventListener('hashchange', function () {
  render()
}, false);

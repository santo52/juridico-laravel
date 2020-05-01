function render() {
  const url = location.hash.replace('#', '')
  if (url) {
    $.ajax({
      url,
      data: new URLSearchParams({}),
      success: data => {

        if(data.redirect){
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

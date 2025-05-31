<?
$file = <<<'FILE'
// 'md2html.js', a Markdown converter
// Scott McGann - whitehotrobot@gmail.com
// all rights reserved - ©2025

const Convert = (src, el='') => {
  
  var wSrc = src.replaceAll("\r\n", "\n")
  var wSrc = wSrc.replaceAll("<br>", "\n")
  var ret = ''
  if(el) el.innerHTML = ''
  src.split("\n").forEach(line => {
    if(line){
      var fontSize = "1em"
      var tagName = 'div'
      var skipShift = false
      var isLi = false
      var tok1 = line.split(' ')
      if(tok1.length > 0){
        for(var i = 1e4; i--;) if(tok1[0] == `${i+1}.`) {
          tagName = `ol start="${i+1}"`
          isLi = true
        }
        switch(tok1[0]){
          case '>': tagName = 'blockquote'; break
          case '`code`': tagName = 'code'; break
          case '---': tagName = 'hr'; break
          case '-': tagName = 'ul'; isLi=true; break
          case '#': tagName = 'H1'; break
          case '##': tagName = 'H2'; break
          case '###': tagName = 'H3'; break
          case '####': tagName = 'H4'; break
          case '#####': tagName = 'H5'; break
          default: if(!isLi) skipShift = true; break
        }
        if(!skipShift) tok1.shift()
        line = tok1.join(' ')
        if(isLi) line = `<li>${line}</li>`
      }
      var rLine = `<${tagName}>`

      // images
      if(line.split('![').length > 1 && line.split(']').length > 1 &&
         line.split('](').length > 1 && line.split(')').length > 1){
        var links = []
        line.split('![').forEach((p1, idx) =>{
          if(idx){
            var title = p1.split(']')[0]
            var url = p1.split('(')[1].split(')')[0]
            links = [...links, {title, url}]
          }
        })
        var s = ''
        var tog = true
        var ct = 0
        line.split('').forEach(chr => {
          if(chr == '!') tog =false
          if(tog) s += chr
          if(!tog && chr == ')') {
            s+=`<img title="${links[ct].title}"
                 src="${links[ct].url}"
                 target="_blank"
                 alt="${links[ct].title}"/>`
            tog = true
            ct++
          }
        })
        line = s
      }

      // links
      if(line.split('[').length > 1 && line.split(']').length > 1 &&
         line.split('](').length > 1 && line.split(')').length > 1){
        var links = []
        line.split('[').forEach((p1, idx) =>{
          if(idx){
            var title = p1.split(']')[0]
            var url = p1.split('(')[1].split(')')[0]
            links = [...links, {title, url}]
          }
        })
        var s = ''
        var tog = true
        var ct = 0
        line.split('').forEach(chr => {
          if(chr == '[') tog =false
          if(tog) s += chr
          if(!tog && chr == ')') {
            s+=`<a
                href="${links[ct].url}"
                title="${links[ct].title}"
                target="_blank"
                >${links[ct].title}</a>`
            tog = true
            ct++
          }
        })
        line = s
      }

      // bold text
      if(line.split('**').length > 1 && line.split('**').length%2==1){
        var v = ''
        var l = line.split('**')
        l.forEach((part, idx) => {
          v += part + (idx < l.length-1 ? (idx%2?'</b>':'<b>') : '')
        })
        line = v
      }

      // italic text
      if(line.split('*').length > 1 && line.split('*').length%2==1){
        var v = ''
        var l = line.split('*')
        l.forEach((part, idx) => {
          v += part + (idx < l.length-1 ? (idx%2?'</i>':'<i>') : '')
        })
        line = v
      }
      
      rLine += line
      rLine += `</${tagName}>`
      ret += rLine
    }else{
      ret += '<br>'
    }
  })
  if(el) el.innerHTML = ret
  return ret
}

export {
  Convert
}

FILE;
file_put_contents('../../md2html.js/md2html.js', $file);
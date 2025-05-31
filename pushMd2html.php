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
        switch(tok1[0]){
          case '>': tagName = 'blockquote'; break
          case '#': tagName = 'H1'; break
          case '`code`': tagName = 'code'; break
          case '---': tagName = 'hr'; break
          case '-': tagName = 'ul'; isLi=true; break
          case '1.': tagName = `ol start=\"1\"}`; isLi=true; break
          case '2.': tagName = `ol start=\"2\"}`; isLi=true; break
          case '3.': tagName = `ol start=\"3\"}`; isLi=true; break
          case '4.': tagName = `ol start=\"4\"}`; isLi=true; break
          case '5.': tagName = `ol start=\"5\"}`; isLi=true; break
          case '6.': tagName = `ol start=\"6\"}`; isLi=true; break
          case '7.': tagName = `ol start=\"7\"}`; isLi=true; break
          case '8.': tagName = `ol start=\"8\"}`; isLi=true; break
          case '9.': tagName = `ol start=\"9\"}`; isLi=true; break
          case '10.': tagName = `ol start=\"10\"}`; isLi=true; break
          case '11.': tagName = `ol start=\"11\"}`; isLi=true; break
          case '12.': tagName = `ol start=\"12\"}`; isLi=true; break
          case '13.': tagName = `ol start=\"13\"}`; isLi=true; break
          case '14.': tagName = `ol start=\"14\"}`; isLi=true; break
          case '15.': tagName = `ol start=\"15\"}`; isLi=true; break
          case '16.': tagName = `ol start=\"16\"}`; isLi=true; break
          case '17.': tagName = `ol start=\"17\"}`; isLi=true; break
          case '18.': tagName = `ol start=\"18\"}`; isLi=true; break
          case '19.': tagName = `ol start=\"19\"}`; isLi=true; break
          case '20.': tagName = `ol start=\"20\"}`; isLi=true; break
          case '##': tagName = 'H2'; break
          case '###': tagName = 'H3'; break
          case '####': tagName = 'H4'; break
          case '#####': tagName = 'H5'; break
          default: skipShift = true; break
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
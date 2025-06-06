<?
$file = <<<'FILE'
<!DOCTYPE html>
<html>
  <head>
    <style>
      body, html{
        background: #000;
        color: #fff;
        margin: 0;
        min-height: vw;
        font-family: verdana;
        margin: 10px;
        word-break: break-word;
      }
      blockquote{
        border-left: 5px solid #888;
        margin: 1.5em 10px;
        padding: .5em 10px;
      }
      a{
        color: #f08;
      }
      a:visited{
        color: #804;
      }
      code{
        color: #aaa;
        display: block;
      }
    </style>
  </head>
  <body>
  
    <div id="myDiv"></div>
    
    <script type="module">
      import * as MarkdownToHTML from "./md2html.js"
      
      var input =
`## my section title

this is my section text. this **word** should be bold!


some text with a [nice link](https://www.google.com) in it, and [another one](https://www.w3schools.com/cssref/sel_link.php), and another one [flock game](https://boss.veriler.com/flock/?arena=qKbllAwM8&name=Maximus%20Salina).......

![nebula](https://boss.veriler.com/assets/uploads/1Jddph.jpeg) ![nebula](https://boss.veriler.com/assets/uploads/1Jddph.jpeg)
![nebula](https://boss.veriler.com/assets/uploads/1Jddph.jpeg) ![nebula](https://boss.veriler.com/assets/uploads/1Jddph.jpeg)

### a sub-section

\`code\` line of code here....

more text......
some *italicized* text...
doot
---
1. my first ** *orderered* ** list item 
2. my second ** *orderered* ** list item 
3. another ** *orderered* ** list item

...and another list

- my first ***UNorderered*** list item 
- my second ***UNorderered*** list item 
- another ***UNorderered*** list item

> some block-quoted text... herp a derp 123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789 123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789 123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789 123456789 123456789 123456789 123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789123456789

more text..... below

`
      
      console.log(input)
      
      console.log(MarkdownToHTML.Convert(input, myDiv))
      
    </script>
  </body>
</html>

FILE;
file_put_contents('../../md2html.js/index.html', $file);
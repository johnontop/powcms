
  <!-- http://mesdomaines.nu/eendracht/rte/tinymce_explanations.html -->
<?php if(file_exists($root.'res/tinymce/tinymce.min.js')) { ;?>  
    <script src="/res/tinymce/tinymce.min.js"></script>   
  <?php } else { ;?> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/tinymce.min.js"></script>
<?php } ;?>     
  
<script type="text/javascript">
tinymce.init({
        mode : "specific_textareas",
        editor_selector : "myBasicEditor",
        // This disables a tinyMCE security feature adding rel="noopener" to target="_blank".
        allow_unsafe_link_target: true,
        //spellchecker_rpc_url: 'spellchecker.php',
        //selector: ".",        
      <?php if ($spellcheck == 1){  ?>   // check if $spellcheck is enbled in user-pass.php  
       browser_spellcheck : true,
      <?php } ?>        
        entity_encoding : "raw",
        force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
        paste_data_images: true,
        protect: [
        /<\?php[\s\S]*?\?>/g // Protect php code
        ],
        height : "440px",
        theme: 'modern',
        skin : "powcms",  
        // TinyMCE premium plugins advcode codesample toc tinymcespellchecker a11ychecker linkchecker textpattern       
        plugins: [
                "paragraph tiny_mce_wiris youtube eqneditor toc advlist autolink autosave link image imagetools lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table directionality emoticons template textcolor paste textcolor colorpicker textpattern"
        ], 
        valid_elements : '*[*]',              
        extended_valid_elements : 'a[class|id|name|href|target|title|onclick|rel],li[data-mce-fragment], script[type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|float|onmouseover|onmouseout|name],$elements,strong/b,div[align|class|style|id],br',

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify toc | formatselect fontselect fontsizeselect styleselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media youtube | insertdatetime | eqneditor tiny_mce_wiris_formulaEditor tiny_mce_wiris_formulaEditorChemistry",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | ltr rtl | spellchecker | visualchars visualblocks  showparagraphs nonbreaking template pagebreak restoredraft | print fullscreen  | preview code",
        menubar: true,
        image_advtab: true,
        image_title: true,
        toolbar_items_size: 'small',
        link_class_list: [
         {title: 'None', value: ''},
         {title: 'Button', value: 'button'},
         {title: 'Popup Image', value: 'responsive'}
        ],
      //image_advtab: true,
      file_picker_callback: function(callback, value, meta) {
      if (meta.filetype == 'image') {
        $('#upload').trigger('click');
        $('#upload').on('change', function() {
          var file = this.files[0];
          var reader = new FileReader();
          reader.onload = function(e) {
            callback(e.target.result, {
              alt: ''
            });
          };
          reader.readAsDataURL(file);
        });
      }
    },
        style_formats: [
                {title: 'Bold text', inline: 'b'},
                {title: 'Red text', inline: 'span', styles: {color: '#ff0000'}},
                {title: 'Red header', block: 'h1', styles: {color: '#ff0000'}},
                {title: 'Example 1', inline: 'span', classes: 'example1'},
                {title: 'Example 2', inline: 'span', classes: 'example2'},
                {title: 'Table styles'},
                {title: 'Table row 1', selector: 'tr', classes: 'tablerow1'}
        ],

        templates: [
                {title: 'Bootstrap - row with 2 columns', content: '	<div class="row"><div class="col-md-6">First col-md-6</div><div class="col-md-6">Second col-md-6</div></div>'},
                {title: 'Test template 2', content: 'Test 2'}
        ],
        content_css: [
        '/res/bootstrap/bootstrap.min.css', '/theme/custom.css'    
        ]        
});
</script>

<!--
extended_valid_elements : "a[class|name|href|target|title|onclick|rel],script[type|src],"
+"iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder],""
+"img[class|src|border=0|alt|title|hspace|vspace|width|height|align|float|onmouseover|onmouseout|name],$elements,strong/b,div[align|class|id],br",

valid_elements : "@[id|class|style|title|dir<ltr?rtl|lang|xml::lang|onclick|ondblclick|"
+ "onmousedown|onmouseup|onmouseover|onmousemove|onmouseout|onkeypress|"
+ "onkeydown|onkeyup],a[rel|rev|charset|hreflang|tabindex|accesskey|type|"
+ "name|href|target|title|class|onfocus|onblur],strong/b,em/i,strike,u,"
+ "#p,-ol[type|compact],-ul[type|compact],-li,br,img[longdesc|usemap|"
+ "src|border|alt=|title|hspace|vspace|width|height|align],-sub,-sup,"
+ "-blockquote,-table[border=0|cellspacing|cellpadding|width|frame|rules|"
+ "height|align|summary|bgcolor|background|bordercolor],-tr[rowspan|width|"
+ "height|align|valign|bgcolor|background|bordercolor],tbody,thead,tfoot,"
+ "#td[colspan|rowspan|width|height|align|valign|bgcolor|background|bordercolor"
+ "|scope],#th[colspan|rowspan|width|height|align|valign|scope],caption,-div,"
+ "-span,-code,-pre,address,-h1,-h2,-h3,-h4,-h5,-h6,hr[size|noshade],-font[face"
+ "|size|color],dd,dl,dt,cite,abbr,acronym,del[datetime|cite],ins[datetime|cite],"
+ "object[classid|width|height|codebase|*],param[name|value|_value],embed[type|width"
+ "|height|src|*],script[src|type],map[name],area[shape|coords|href|alt|target],bdo,"
+ "button,col[align|char|charoff|span|valign|width],colgroup[align|char|charoff|span|"
+ "valign|width],dfn,fieldset,form[action|accept|accept-charset|enctype|method],"
+ "input[accept|alt|checked|disabled|maxlength|name|readonly|size|src|type|value],"
+ "kbd,label[for],legend,noscript,optgroup[label|disabled],option[disabled|label|selected|value],"
+ "q[cite],samp,select[disabled|multiple|name|size],small,"
+ "textarea[cols|rows|disabled|name|readonly],tt,var,big"

HtmlEditorConfig::get('cms')// Add support for HTML5 elements in tinymce editor
    ->setOption('extended_valid_elements',
        '+article,aside,audio[src|preload<none?metadata?auto|autoplay<autoplay|loop<loop|controls<controls|mediagroup],canvas[width,height],'
        .'datalist[data],details[open<open],eventsource[src],fieldset[disabled<disabled|form|name],header,mark,menu[type<context?toolbar?list|label],'
        .'meter[value|min|low|high|max|optimum],nav,progress[value,max],script[src|async<async|defer<defer|type|charset],section,time[datetime],'
        .'video[preload<none?metadata?auto|src|crossorigin|poster|autoplay<autoplay|mediagroup|loop<loop|muted<muted|controls<controls|width|height],wbr,#span,'
        .'form[id|method|onsubmit|onreset|action],input[id|name|style|type|placeholder],label[for]'
    )
    ->setOptions(array(//clean up the actions upon pasting text in
        'paste_remove_spans'            => true,
        'paste_remove_styles'           => true,
        'paste_remove_styles_if_webkit' => true,
        'force_br_newlines'             => true,
        'force_p_newlines'              => false,
        'paste_text_linebreaktype'      => "br",
        'paste_remove_styles'           => true,
        'paste_auto_cleanup_on_paste'   => true,
    ));
    
-->    
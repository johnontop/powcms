  <!-- http://mesdomaines.nu/eendracht/rte/tinymce_explanations.html -->
  <script src="/res/tinymce/tinymce.min.js"></script>

<script type="text/javascript">
tinymce.init({
        mode : "specific_textareas",
        editor_selector : "myBasicEditor", 
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
        skin : "pollyx",
         theme: 'modern',
        plugins: [
                "advlist autolink autosave link image lists charmap print preview hr anchor pagebreak spellchecker",
                "searchreplace wordcount visualblocks visualchars code fullscreen insertdatetime media nonbreaking",
                "table directionality emoticons template textcolor paste textcolor colorpicker textpattern"
        ],               
        extended_valid_elements : 'a[class|name|href|target|title|onclick|rel],script[type|src],iframe[src|style|width|height|scrolling|marginwidth|marginheight|frameborder],img[class|src|border=0|alt|title|hspace|vspace|width|height|align|onmouseover|onmouseout|name],$elements,strong/b,div[align|class|id],br',

        toolbar1: "newdocument fullpage | bold italic underline strikethrough | forecolor backcolor | alignleft aligncenter alignright alignjustify | formatselect fontselect fontsizeselect styleselect",
        toolbar2: "cut copy paste | searchreplace | bullist numlist | outdent indent blockquote | undo redo | link unlink anchor image media | insertdatetime preview code ",
        toolbar3: "table | hr removeformat | subscript superscript | charmap emoticons | ltr rtl | spellchecker | visualchars visualblocks nonbreaking template pagebreak restoredraft | print fullscreen",
        menubar: true,
        toolbar_items_size: 'small',
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
                {title: '2 column', content: '	<div class="row"><div class="col-md-6">First</div><div class="col-md-6">Second</div></div>'},
                {title: 'Test template 2', content: 'Test 2'}
        ],
        content_css: [
        '/res/bootstrap/bootstrap.min.css'   
        ]        
});
</script>
  
<?php if(file_exists($root.'res/tinymce/tinymce.min.js')) { ;?>  
    <script src="/res/tinymce/tinymce.min.js"></script>   
  <?php } else { ;?> 
    <script src="https://cdnjs.cloudflare.com/ajax/libs/tinymce/4.7.4/tinymce.min.js"></script>
<?php } ;?>     
  
<script type="text/javascript">
tinymce.init({
        mode : "specific_textareas",
        editor_selector : "myBasicEditor",
        allow_unsafe_link_target: true,      
        entity_encoding : "raw",
        force_br_newlines : true,
        force_p_newlines : false,
        forced_root_block : '',
        paste_data_images: true,
        height : "440px",
        valid_elements : '*[*]',              
});
</script>


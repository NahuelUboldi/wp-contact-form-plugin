
<form id="enquiry_form">
 <?php wp_nonce_field('wp_rest'); ?>


 <label>name</label><br>
 <input type="text" name="name"><br><br>
 
 <label>email</label><br>
 <input type="text" name="email"><br><br>
 
 <label>phone</label><br>
 <input type="text" name="phone"><br><br>

 <label>message</label><br>
 <textarea name="message" id="" cols="30" rows="10"></textarea><br><br>

 <button type="submit">Submit form</button>
</form>
<script >
  jQuery(document).ready(function($) {

    $("#enquiry_form").submit(function(e){
      e.preventDefault();

      var form = $(this);

      $.ajax({
        type:"POST",
        url:"<?php echo get_rest_url( null, 'v1/contact-form/submit'); ?>",
        data:form.serialize()
      })

    })

  })

 </script>

<form id="enquiry_form">
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

<script>
  window.jQuery || document.write('<script src="http://mysite.com/jquery.min.js"><\/script>'))
  jQuery(document).ready(function($) {
    $('#enquiry_form').submit(function(event) {
      event.preventDefault();
      alert('ok')
    })
  })
</script>
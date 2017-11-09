<section id="contact" class="contact">
<div class="container-fluid paral paralsec">
  <div class="row">
    <div id="feedback">
      <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#feedback-modal">
        <img src="<?= get_template_directory_uri(); ?>/assets/images/ico_hand.svg" alt="Web developer"/>

        Hire Me!
      </button></div>
    <div class="col-12">
      <form class="feedback" name="feedback">
      <strong>Name</strong>
      <br />
      <input type="text" name="name" class="input-xlarge" value="">
      <br /><br /><strong>Email</strong><br />
      <input type="email" name="email" class="input-xlarge" value="">
      <br /><br /><strong>Message</strong><br />
      <textarea name="message" class="input-xlarge"></textarea>
      </form>
        <button class="btn btn-success" id="submit">Send</button>
</div>
  </div>
</div>
 </section>

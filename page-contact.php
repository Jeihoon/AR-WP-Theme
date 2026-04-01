<?php
/**
 * Template Name: Contact (AR Theme)
 */

$success_message = '';

if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['ar_form_submit'])) {
  $name    = sanitize_text_field($_POST['ar-name']);
  $email   = sanitize_email($_POST['ar-email']);
  $message = sanitize_textarea_field($_POST['ar-message']);

  $to      = get_option('admin_email'); // Send to site admin
  $from    = get_option('admin_email'); // From admin email

  $subject = 'New message from ' . $name;
  $headers = array(
    'Content-Type: text/html; charset=UTF-8',
    'From: ' . get_bloginfo('name') . ' <' . $from . '>',
    'Reply-To: ' . $email,
  );

  $body = "<strong>Name:</strong> $name<br>
           <strong>Email:</strong> $email<br>
           <strong>Message:</strong><br>" . nl2br($message);

  if (wp_mail($to, $subject, $body, $headers)) {
    $success_message = '<div class="alert alert-success mt-4">Thank you! Your message has been sent.</div>';
  } else {
    $success_message = '<div class="alert alert-danger mt-4">Sorry, something went wrong. Please try again.</div>';
  }
}

get_header();
?>

<main class="container py-3 mt-3">
  <h1 class="mb-4 text-left" style="margin-top: 20px"><?php the_title(); ?></h1>
  <div class="ar-contact-intro mb-4 text-center">
    <?php the_content(); ?>
  </div>

  <div class="ar-contact-form">
    <form method="post" action="">
      <div class="is-style-default wp-block-group">
        <div class="wp-block-columns">
          <div class="wp-block-column">
            <label for="ar-name" style="font-weight:500;">Name</label>
            <input type="text" id="ar-name" name="ar-name" class="form-control" placeholder="Your Name" required>
          </div>
          <div class="wp-block-column">
            <label for="ar-email" style="font-weight:500;">Email</label>
            <input type="email" id="ar-email" name="ar-email" class="form-control" placeholder="you@email.com" required>
          </div>
        </div>
        <div class="mb-3 mt-3">
          <label for="ar-message" style="font-weight:500;">Message</label>
          <textarea id="ar-message" name="ar-message" rows="6" class="form-control" placeholder="Type your message here..." required></textarea>
        </div>
        <div class="ar-btn-row">
          <button type="submit" name="ar_form_submit" value="1" class="ar-btn-submit wp-block-button__link">Send Message</button>
        </div>
      </div>
    </form>

    <!-- ✅ Output success message here -->
    <?php echo $success_message; ?>

    <div class="small mt-2 text-muted">* This form sends via wp_mail().</div>
  </div>
</main>

<?php get_footer(); ?>

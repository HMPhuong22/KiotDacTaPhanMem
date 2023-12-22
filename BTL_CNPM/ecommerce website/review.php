<?php

include 'components/connect.php';

session_start();

if (isset($_SESSION['user_id'])) {
   $user_id = $_SESSION['user_id'];
} else {
   $user_id = '';
   header('location:user_login.php');
};

if (isset($_POST['send'])) {

   // $name = $_POST['name'];
   // $name = filter_var($name, FILTER_SANITIZE_STRING);
   // $email = $_POST['email'];
   // $email = filter_var($email, FILTER_SANITIZE_STRING);
   // $number = $_POST['number'];
   // $number = filter_var($number, FILTER_SANITIZE_STRING);
   $msg = $_POST['msg'];
   $msg = filter_var($msg, FILTER_SANITIZE_STRING);
   $star = $_POST['rating'];
   $star = filter_var($star, FILTER_SANITIZE_STRING);

   // $select_message = $conn->prepare("SELECT * FROM `messages` WHERE name = ? AND email = ? AND number = ? AND message = ?");
   // $select_message->execute([$name, $email, $number, $msg]);
   $insert_message = $conn->prepare("INSERT INTO `review`(user_id, review, star) VALUES(?,?,?)");
   $insert_message->execute([$user_id, $msg, $star]);

   $message[] = 'sent review successfully!';
   header('location:about.php');
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
   <meta charset="UTF-8">
   <meta http-equiv="X-UA-Compatible" content="IE=edge">
   <meta name="viewport" content="width=device-width, initial-scale=1.0">
   <title>Đánh giá dịch vụ</title>

   <!-- font awesome cdn link  -->
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.1/css/all.min.css">

   <!-- custom css file link  -->
   <link rel="stylesheet" href="css/style.scss">

</head>

<body>

   <?php include 'components/user_header.php'; ?>

   <section class="contact">

      <form action="" method="post">
         <h3>Đánh giá dịch vụ</h3>
         <textarea name="msg" class="box" placeholder="enter your message" cols="30" rows="10"></textarea>
         <div class="stars">
            <i class="fa-regular fa-star" data-rating="1"></i>
            <i class="fa-regular fa-star" data-rating="2"></i>
            <i class="fa-regular fa-star" data-rating="3"></i>
            <i class="fa-regular fa-star" data-rating="4"></i>
            <i class="fa-regular fa-star" data-rating="5"></i>

         </div>
         <input type="hidden" id="rating-input" name="rating" value="rating">
         <input type="submit" value="send message" name="send" class="btn">
      </form>

   </section>

   <script>
      const stars = document.querySelectorAll('.stars i');
      const ratingInput = document.getElementById('rating-input');

      stars.forEach(star => {
         star.addEventListener('mouseenter', () => {
            const rating = star.getAttribute('data-rating');
            highlightStars(rating);
         });

         star.addEventListener('mouseleave', () => {
            resetStars();
         });

         star.addEventListener('click', () => {
            const rating = star.getAttribute('data-rating');
            ratingInput.value = rating;
         });
      });

      function highlightStars(rating) {
         stars.forEach(star => {
            const starRating = star.getAttribute('data-rating');
            if (starRating <= rating) {
               star.classList.add('fas');
               star.classList.remove('fa-regular');
            } else {
               star.classList.remove('fas');
               star.classList.add('fa-regular');
            }
         });
      }

      function resetStars() {
         stars.forEach(star => {
            const starRating = star.getAttribute('data-rating');
            if (starRating <= ratingInput.value) {
               star.classList.add('fas');
               star.classList.remove('fa-regular');
            } else {
               star.classList.remove('fas');
               star.classList.add('fa-regular');
            }
         });
      }
   </script>











   <?php include 'components/footer.php'; ?>

   <script src="js/script.js"></script>

</body>

</html>
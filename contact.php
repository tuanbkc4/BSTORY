 <!-- Title -->
 <script type="text/javascript">
   document.title = "Contact | VinaEnter Edu";
 </script>

 <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/header.php'; ?>
 <div class="content_resize">
   <div class="mainbar">
     <div class="article">
       <h2><span>Liên hệ</span></h2>
       <div class="clr"></div>
       <p>Nếu có thắc mắc hoặc góp ý, vui lòng liên hệ với chúng tôi theo thông tin dưới đây.</p>
     </div>
     <div class="article">
       <h2>Form liên hệ</h2>

       <div class="clr"></div>
       <script type="text/javascript">
         $(document).ready(function() {
           $('.formContact').validate({
             rules: {
               name: {
                 required: true,
               },
               email: {
                 required: true,
                 email: true

               },
               website: {
                 required: true,
                 url: true
               },
               message: {
                 required: true
               }

             },
             messages: {
               name: {
                 required: 'Vui lòng nhập họ tên',
               },
               email: {
                 required: 'Vui lòng nhập email',
                 email: 'email không hợp lệ'

               },
               website: {
                 required: 'Vui lòng nhập website',
                 url: 'website không hợp lệ'
               },
               message: {
                 required: 'Vui lòng nhập message'
               }
             }
           });
         });
       </script>
       <?php
        $name = $email = $website = $content = "";
        $nameErr = $emailErr = $websiteErr = $contentErr = "";
        if (isset($_POST['submit'])) {
          $name = trim($_POST['name']);
          $email = trim($_POST['email']);
          $website = trim($_POST['website']);
          $content = trim($_POST['message']);
          // kiểm tra 
          // name
          if ($name == "") {
            $nameErr = "Vui lòng nhập họ tên";
          } else {
            if (!checkName($name)) {
              $nameErr = "Tên không hợp lệ";
              $name = "";
            }
          }
          // website
          if ($website == "") {
            $websiteErr = "Vui lòng nhập website";
          } else {
            if (!checkWebsite($website)) {
              $websiteErr = "website không hợp lệ";
              $website = "";
            }
          }
          // email
          if ($email == "") {
            $emailErr = "Vui lòng nhập email";
          } else {
            if (!checkEmail($email)) {
              $emailErr = "email không hợp lệ";
              $email = "";
            }
          }
          // content
          if ($content == "") {
            $contentErr = "Vui lòng nhập message";
          }
          // Thực thi câu truy vấn khi không có lỗi            
          if ($nameErr == "" && $emailErr == "" && $websiteErr == "" && $contentErr == "") {
            $qr = "INSERT INTO contact(name,email,website,content) VALUES ('$name', '$email', '$website','$content')";
            $result = $conn->query($qr);
            if ($result) {
              $msg = "Gửi liên hệ thành công";
            } else {
              $msgErr = "Gửi liên hệ thất bại";
            }
          } else {
            $msgErr = "Vui lòng kiểm tra lại thông tin";
          }
        }

        ?>
       <form action="#" method="POST" id="sendemail" class="formContact">
         <ol>
           <li>
             <label for="name">Họ tên (required)</label>
             <input style="width:100%;padding:14px 8px;" id="name" name="name" class="text" value="<?php echo $name; ?>" />
             <span class="errInput"><?php echo $nameErr; ?></span>
           </li>
           <li>
             <label for="email">Email (required)</label>
             <input style="width:100%;padding:14px 8px;" id="email" name="email" class="text" value="<?php echo $email; ?>" />
             <span class="errInput"><?php echo $emailErr; ?></span>
           </li>
           <li>
             <label for="website">Website</label>
             <input style="width:100%;padding:14px 8px;" id="website" name="website" class="text" value="<?php echo $website; ?>" />
             <span class="errInput"><?php echo $websiteErr; ?></span>
           </li>
           <li>
             <label for="message">Nội dung</label>
             <textarea id="message" name="message" rows="8" cols="50" style="width:100%"><?php echo $content; ?></textarea>
             <span class="errInput"><?php echo $contentErr; ?></span>
           </li>
           <li>
             <input style="display:block;margin-right:auto;margin-left:auto;padding:2px 32px;font-size:13px;cursor:pointer" type="submit" name="submit" id="imageField" value="Gửi" class="send" />
             <?php
              if (isset($msg)) {
              ?>
               <span class="msg"><?php echo $msg; ?></span>
             <?php
              }
              if (isset($msgErr)) {
              ?>
               <span class="msgErr"><?php echo $msgErr; ?></span>
             <?php
              }
              ?>
             <div class="clr"></div>
           </li>
         </ol>
       </form>
     </div>
   </div>
   <style>
     .error {
       font-size: 15px;
       color: red;
       font-style: italic;
       display: block;
       padding: 0;
     }

     .errInput {
       font-size: 15px;
       color: red;
       font-style: italic;
       margin-top: 4px;
       margin-left: 4px;
       display: block;
     }

     .msg {
       display: block;
       text-align: center;
       margin-top: 8px;
       font-size: 15px;
       color: green;
     }

     .msgErr {
       display: block;
       text-align: center;
       margin-top: 8px;
       font-size: 15px;
       color: red;
     }
   </style>
   <div class="sidebar">
     <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/leftbar.php'; ?>
   </div>
   <div class="clr"></div>
 </div>
 <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/footer.php'; ?>

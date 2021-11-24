<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/header.php'; ?>
<div class="content_resize">
  <div class="mainbar">
    <?php
    $story_id = $_GET['id'];
    $qr = "SELECT * FROM story WHERE story_id = '$story_id' ORDER BY story_id DESC";
    $result = $conn->query($qr);
    $arItem = $result->fetch_assoc();
    // increase counter
    $arItem['counter'] += 1;
    $qrCounterIncrease = "UPDATE story SET counter = {$arItem['counter']} WHERE story_id = '$story_id'";
    $conn->query($qrCounterIncrease);
    ?>
    <!-- Title -->
    <script type="text/javascript">
      document.title = "<?php echo $arItem['name']; ?>";
    </script>

    <div class="article">
      <h1><?php echo $arItem['name']; ?></h1>
      <div class="clr"></div>
      <p>Ngày đăng: <?php echo $arItem['created_at']; ?>. Lượt đọc: <?php echo $arItem['counter']; ?></p>
      <div class="vnecontent">
        <p><?php echo $arItem['detail_text']; ?></p>
      </div>
    </div>
    <style>
      .main_comment li {
        display: flex;
        justify-content: flex-start;
        align-self: center;
        gap: 15px;
      }

      .avt {
        width: 40px;
        height: 40px;
        border-radius: 50%;
        display: inline-block;
        flex-shrink: 0;
      }

      .main_comment .desc {
        flex: 1;
      }

      .main_comment .desc .contentMainComment {
        position: relative;
      }

      .main_comment .desc .edit_comment {
        position: absolute;
        right: 20px;
        top: 5px;
        cursor: pointer;
        font-size: 14px;
      }

      .edit_Subcomment {
        align-self: center;
        margin-left: auto;
        margin-right: 20px;
        font-size: 14px;
        cursor: pointer;
      }

      .edit_Subcomment,
      .edit_comment {
        position: relative;
      }

      .edit_Subcomment .menuEdit,
      .edit_comment .menuEdit {
        position: absolute;
        width: 70px;
        top: 0;
        left: 0px;
        background-color: #fff;
        padding: 0;
        box-shadow: 3px 2px 5px #ccc;
        display: none;
      }

      .activeblock {
        display: block !important;
      }

      .edit_Subcomment .menuEdit p,
      .edit_comment .menuEdit p {
        padding: 2px 6px;
        margin: 0;
        font-size: 12px;
      }

      .edit_Subcomment .menuEdit p:hover,
      .edit_comment .menuEdit p:hover {
        background-color: #DFDFDF;
      }

      .editcontentComment {
        display: none;
      }

      /* .main_comment li:hover .editcontentComment{
        display: block;
      } */
      .main_comment .descComment:hover .edit_comment,
      .sub_comment>li:hover .edit_Subcomment {
        display: block;
      }

      .editcontentComment:hover .menuEdit {
        display: block;
      }



      .nameUser {
        text-decoration: none;
        font-weight: 600;
        color: #2E002F;
      }

      .interact {
        display: flex;
        justify-content: flex-start;
        gap: 8px;
        margin-bottom: 8px;
      }

      .interact .time {
        font-weight: normal;
      }

      .interact button {
        outline: none;
        border: none;
        font-weight: 550;
        color: #636363;
        padding: 0;
        font-size: 12px;
      }

      .interact .like {
        margin-right: 2px;
      }

      .liked {
        color: blue !important;
      }

      .interact .reply:hover,
      .interact .like:hover {
        cursor: pointer;
        text-decoration: underline;
      }

      .sub_comment {
        padding-left: 8px;
        border-left: 2px solid #ccc;
      }

      .form_comment {
        display: flex;
        justify-content: flex-start;
        align-self: center;
        gap: 15px;
        margin-top: 12px;
        width: 100%;
      }

      .sub {
        margin-top: 0;
        margin-bottom: 12px;
        display: none;
      }

      .activeSubComment {
        display: flex;
      }

      .form_comment input[type="text"] {
        border-radius: 12px;
        outline: none;
        border: 1px solid #ccc;
        flex: 1;
        padding-left: 12px;
        font-size: 15px;
      }

      .form_comment input[type="text"]:focus {
        border: 1px solid #0079BA;
      }

      .form_comment input[type="submit"] {
        display: none;
      }

      .active_input_comment {
        display: block;
      }
    </style>
    <div class="article comment_story">
      <hr />
      <h2>Bình luận truyện</h2>
      <ul class="main_comment">
        <?php
        $qrComment = "SELECT comment.*,users.fullname,users.avt FROM comment INNER JOIN users ON comment.user_id = users.user_id WHERE comment.story_id = '$story_id'";
        $resultComment = $conn->query($qrComment);
        if ($resultComment->num_rows > 0) {
          while ($arItemComment = $resultComment->fetch_assoc()) {
            $comment_id = $arItemComment['comment_id'];
        ?>
            <li>
              <?php
              if (isset($arItemComment['avt'])) {
              ?>
                <img src="/files/avt/<?php echo $arItemComment['avt']; ?>" class="avt"></img>
              <?php
              } else {
              ?>
                <img src="/files/avt/default.jpg ?>" class="avt"></img>
              <?php
              }
              ?>

              <div class="desc">
                <div class="descComment">
                  <div class="contentMainComment">
                    <a href="#" class="nameUser"><?php echo $arItemComment['fullname']; ?></a>
                    <p class="content"><?php echo $arItemComment['content']; ?></p>
                    <?php
                    if (isset($_SESSION['arUser'])) {
                      if ($_SESSION['arUser']['user_id'] == $arItemComment['user_id']) {
                    ?>
                        <div class="editcontentComment edit_comment">
                          <div><i class="fa fa-ellipsis-v " aria-hidden="true"></i></div>
                          <div class="menuEdit">
                            <p class="del_Comment <?php echo $comment_id; ?>">Xoá</p>
                            <p class="rewrite_Comment <?php echo $comment_id; ?>">Chỉnh sửa</p>
                          </div>
                        </div>
                    <?php
                      }
                    }
                    ?>
                  </div>
                  <div class="interact interactComment-<?php echo $comment_id; ?>">
                    <?php
                    if (isset($_SESSION['arUser'])) {
                      if (checkLiked($_SESSION['arUser']['user_id'], $arItemComment['user_liked'])) {
                    ?>
                        <button value="<?php echo $comment_id; ?>" class="like liked likeComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemComment['counter_like']; ?></i></button>
                      <?php
                      } else {
                      ?>
                        <button value="<?php echo $comment_id; ?>" class="like likeComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemComment['counter_like']; ?></i></button>
                      <?php
                      }
                    } else {
                      ?>
                      <button value="<?php echo $comment_id; ?>" class="like likeComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemComment['counter_like']; ?></i></button>
                    <?php
                    }
                    ?>
                    <button value="<?php echo $comment_id; ?>" class="reply replyComment">Phản hồi</button>
                    <b class="time"><?php echo time_ago($arItemComment['create_at']); ?></b>
                  </div>
                </div>
                <div class="descSubComment">
                  <ul class="sub_comment sub_comment-<?php echo $arItemComment['comment_id']; ?>">
                    <?php
                    $qrSubComment = "SELECT sub_comment.*,users.fullname,users.avt FROM sub_comment INNER JOIN users ON sub_comment.user_id = users.user_id WHERE sub_comment.comment_id = '$comment_id'";
                    $resultSubComment = $conn->query($qrSubComment);
                    if ($resultSubComment->num_rows > 0) {
                      while ($arItemSubComment = $resultSubComment->fetch_assoc()) {
                        $sub_comment_id = $arItemSubComment['sub_comment_id'];
                    ?>
                        <li>
                          <?php
                          if (isset($arItemSubComment['avt'])) {
                          ?>
                            <img src="/files/avt/<?php echo $arItemSubComment['avt']; ?>" class="avt"></img>
                          <?php
                          } else {
                          ?>
                            <img src="/files/avt/default.jpg ?>" class="avt"></img>
                          <?php
                          }
                          ?>
                          <div>
                            <div class="contentSubComment">
                              <a href="#" class="nameUser"><?php echo $arItemSubComment['fullname']; ?></a>
                              <p class="content"><?php echo $arItemSubComment['content']; ?></p>
                            </div>
                            <div class="interact interactSubComment-<?php echo $sub_comment_id; ?>">
                              <?php
                              if (isset($_SESSION['arUser'])) {
                                if (checkLiked($_SESSION['arUser']['user_id'], $arItemSubComment['user_liked'])) {
                              ?>
                                  <button value="<?php echo $sub_comment_id; ?>" class="like liked likeSubComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemSubComment['counter_like']; ?></i></button>
                                <?php
                                } else {
                                ?>
                                  <button value="<?php echo $sub_comment_id; ?>" class="like likeSubComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemSubComment['counter_like']; ?></i></button>
                                <?php
                                }
                              } else {
                                ?>
                                <button value="<?php echo $sub_comment_id; ?>" class="like likeSubComment"><i class="fa fa-thumbs-o-up" aria-hidden="true"><?php echo ' ' . $arItemSubComment['counter_like']; ?></i></button>
                              <?php
                              }
                              ?>
                              <button value="<?php echo $comment_id; ?>" class="reply replyComment">Phản hồi</button>
                              <b class="time"><?php echo time_ago($arItemSubComment['create_at']); ?></b>
                            </div>
                          </div>
                          <?php
                          if (isset($_SESSION['arUser'])) {
                            if ($_SESSION['arUser']['user_id'] == $arItemSubComment['user_id']) {
                          ?>
                              <div class="editcontentComment edit_Subcomment">
                                <div><i class="fa fa-ellipsis-v  " aria-hidden="true"></i></div>
                                <div class="menuEdit ">
                                  <p class="del_SubComment <?php echo $comment_id . '-' . $sub_comment_id; ?>">Xoá</p>
                                  <p class="rewrite_SubComment <?php echo $comment_id . '-' . $sub_comment_id; ?>">Chỉnh sửa</p>
                                </div>
                              </div>
                          <?php
                            }
                          }
                          ?>
                        </li>
                    <?php
                      }
                    }
                    ?>
                    <li>
                      <form action="javascript:void(0)" class="form_comment sub formComment-<?php echo $comment_id; ?>" method="post">
                        <?php
                        if (isset($_SESSION['arUser']['avt'])) {
                        ?>
                          <img src="/files/avt/<?php echo $_SESSION['arUser']['avt']; ?>" class="avt"></img>
                        <?php
                        } else {
                        ?>
                          <img src="/files/avt/default.jpg" class="avt"></img>
                        <?php
                        }
                        ?>
                        <input type="text" name="contentSub" id="" class="contentSubComment-<?php echo $comment_id; ?>" placeholder="Viết bình luận...">
                        <input class="submitSubComment" type="submit" name="submit" value="<?php echo $comment_id; ?>">
                      </form>
                    </li>
                  </ul>

                </div>

              </div>
            </li>
          <?php
          }
          ?>
        <?php
        }
        ?>

      </ul>
      <form action="javascript:void(0)" class="form_comment" method="post">
        <?php
        if (isset($_SESSION['arUser']['avt'])) {
        ?>
          <img src="/files/avt/<?php echo $_SESSION['arUser']['avt']; ?>" class="avt"></img>
        <?php
        } else {
        ?>
          <img src="/files/avt/default.jpg" class="avt"></img>
        <?php
        }
        ?>
        <input type="text" name="content" id="" class="contentComment mainComment" placeholder="Viết bình luận...">
        <input type="submit" name="submit" value="submit" onclick="getComment()">
      </form>
    </div>
    <script type="text/javascript">
      // ajax - comment
      function getComment() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var content = $('.contentComment').val();
          var content = content.trim();
          var user_id = <?php echo $_SESSION['arUser']['user_id']; ?>;
          var story_id = <?php echo $story_id; ?>;
          $.ajax({
            url: "/ajax/comment.php",
            type: "POST",
            cache: false,
            data: {
              content: content,
              user_id: user_id,
              story_id: story_id

            },
            success: function(data) {
              $(".comment_story").html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>

      }
      // ajax-Subcomment
      $(".comment_story").on("click", ".submitSubComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var comment_id = this.value;
          var idInput = ".contentSubComment-" + comment_id;
          var idDiv = ".sub_comment-" + comment_id;
          var content = $(idInput).val();
          var content = content.trim();
          var user_id = <?php echo $_SESSION['arUser']['user_id']; ?>;
          $.ajax({
            url: "/ajax/subComment.php",
            type: "POST",
            cache: false,
            data: {
              content: content,
              user_id: user_id,
              comment_id: comment_id
            },
            success: function(data) {
              $(idDiv).html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>
      });
      // replycomment
      $(".comment_story").on("click", ".replyComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var comment_id = this.value;
          var idFormComment = ".formComment-" + comment_id;
          $('.sub.activeSubComment').removeClass("activeSubComment");
          $(idFormComment).addClass("activeSubComment");
          var idInputSub = ".contentSubComment-" + comment_id;
          $(idInputSub).focus();
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>
      });
      // hide input subComment when onclick input mainComment
      $(".comment_story").on("click", ".mainComment", function() {
        $('.sub.activeSubComment').removeClass("activeSubComment");
      });
      // del
      // del sub comment
      $(".comment_story").on("click", ".del_SubComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          // var comment_id = id.className.slice(0,id.className.indexOf("-") + 1);
          var id = this.className.slice(this.className.indexOf(" ") + 1);
          var comment_id = id.slice(0, id.indexOf("-"));
          var sub_comment_id = id.slice(id.indexOf("-") + 1);
          var idDiv = ".sub_comment-" + comment_id;

          $.ajax({
            url: "/ajax/del_subComment.php",
            type: "POST",
            cache: false,
            data: {
              comment_id: comment_id,
              sub_comment_id: sub_comment_id
            },
            success: function(data) {
              $(idDiv).html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>

      });
      // del comment
      $(".comment_story").on("click", ".del_Comment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          // var comment_id = id.className.slice(0,id.className.indexOf("-") + 1);
          var comment_id = this.className.slice(this.className.indexOf(" ") + 1);
          var story_id = <?php echo $story_id; ?>;

          $.ajax({
            url: "/ajax/del_comment.php",
            type: "POST",
            cache: false,
            data: {
              comment_id: comment_id,
              story_id: story_id,

            },
            success: function(data) {
              $(".comment_story").html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>

      });
      //rewrite
      //rewrite rewrite SubComment
      $(".comment_story").on("click", ".rewrite_SubComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          // var comment_id = id.className.slice(0,id.className.indexOf("-") + 1);
          var id = this.className.slice(this.className.indexOf(" ") + 1);
          var comment_id = id.slice(0, id.indexOf("-"));
          var sub_comment_id = id.slice(id.indexOf("-") + 1);
          var idDiv = ".sub_comment-" + comment_id;
          $.ajax({
            url: "/ajax/rewrite_subComment.php",
            type: "POST",
            cache: false,
            data: {
              comment_id: comment_id,
              sub_comment_id: sub_comment_id
            },
            success: function(data) {
              $(idDiv).html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>

      });
      // update sub comment
      $(".comment_story").on("click", ".updateSubComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var id = this.value;
          var comment_id = id.slice(0, id.indexOf("-"));
          var sub_comment_id = id.slice(id.indexOf("-") + 1);
          var idInput = ".contentSubComment-" + comment_id;
          var idDiv = ".sub_comment-" + comment_id;
          var content = $(idInput).val();
          var content = content.trim();
          $.ajax({
            url: "/ajax/updateSubComment.php",
            type: "POST",
            cache: false,
            data: {
              content: content,
              comment_id: comment_id,
              sub_comment_id: sub_comment_id
            },
            success: function(data) {
              $(idDiv).html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>
      });
      //rewrite Comment
      $(".comment_story").on("click", ".rewrite_Comment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var comment_id = this.className.slice(this.className.indexOf(" ") + 1);
          var story_id = <?php echo $story_id; ?>;
          $.ajax({
            url: "/ajax/rewrite_comment.php",
            type: "POST",
            cache: false,
            data: {
              comment_id: comment_id,
              story_id: story_id
            },
            success: function(data) {
              $(".comment_story").html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>

      });
      // update comment
      $(".comment_story").on("click", ".updateComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var comment_id = this.value;
          var content = $('.contentComment').val();
          var content = content.trim();
          var story_id = <?php echo $story_id; ?>;
          $.ajax({
            url: "/ajax/updatecomment.php",
            type: "POST",
            cache: false,
            data: {
              comment_id: comment_id,
              content: content,
              story_id: story_id
            },
            success: function(data) {
              $(".comment_story").html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>
      });
      // like comment
      $(".comment_story").on("click", ".likeComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var comment_id = this.value;
          var user_id = <?php echo $_SESSION['arUser']['user_id']; ?>;
          var idDiv = ".interactComment-" + comment_id;
          $.ajax({
            url: "/ajax/likeComment.php",
            type: "POST",
            cache: false,
            data: {
              comment_id: comment_id,
              user_id: user_id
            },
            success: function(data) {
              $(idDiv).html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>
      });
      // like Sub comment
      $(".comment_story").on("click", ".likeSubComment", function() {
        <?php
        if (isset($_SESSION['arUser'])) {
        ?>
          var sub_comment_id = this.value;
          var user_id = <?php echo $_SESSION['arUser']['user_id']; ?>;
          var idDiv = ".interactSubComment-" + sub_comment_id;
          $.ajax({
            url: "/ajax/likeSubComment.php",
            type: "POST",
            cache: false,
            data: {
              sub_comment_id: sub_comment_id,
              user_id: user_id
            },
            success: function(data) {
              $(idDiv).html(data);
            },
            error: function() {
              alert("Đã có lỗi xảy ra");
            }

          });
        <?php
        } else {
        ?>
          alert("bạn chưa đăng nhập!!!");
        <?php
        }
        ?>
      });
    </script>
    <?php
    $qr2 = "SELECT * FROM story WHERE story_id != {$story_id} AND cat_id = {$arItem['cat_id']} ORDER BY story_id DESC LIMIT 3";
    $result2 = $conn->query($qr2);
    if ($result2->num_rows > 0) {
    ?>
      <div class="article">
        <h2>Truyện liên quan</h2>
        <div class="clr"></div>
        <?php
        while ($arItem2 = $result2->fetch_assoc()) {
          $nameReplaceStory = convertUtf8ToLatin($arItem2['name']);
          $url = '/' . $nameReplaceStory . '-' . $arItem2['story_id'] . '.html';
        ?>
          <div class="comment">
            <?php
            if ($arItem2['picture']) {
            ?>
              <a href="<?php echo $url; ?>">
                <img src="/files/<?php echo $arItem2['picture']; ?>" width="40" height="40" alt="" class="userpic" />
              </a>
            <?php
            }
            ?>

            <h3><a href="<?php echo $url; ?>"><?php echo $arItem2['name']; ?></a></h3>
            <p><?php echo $arItem2['preview_text']; ?></p>
          </div>
        <?php
        }
        ?>
      </div>
    <?php
    }
    ?>
  </div>
  <div class="sidebar">
    <?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/leftbar.php'; ?>
  </div>
  <div class="clr"></div>
</div>
<?php include_once $_SERVER['DOCUMENT_ROOT'] . '/templates/bstory/inc/footer.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkUser.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<script type="text/javascript">
    document.title = "Add story | VinaEnter Edu";
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Thêm truyện</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <script type="text/javascript">
            $(document).ready(function() {
                $('.formAddStory').validate({
                    rules: {
                        name: {
                            required: true,
                        },
                        preview_text: {
                            required: true,
                        },
                        detail_text: {
                            required: true,
                        }
                    },
                    messages: {
                        name: {
                            required: 'Vui lòng nhập tên truyện',
                        },
                        preview_text: {
                            required: 'Vui lòng nhập mô tả',
                        },
                        detail_text: {
                            required: 'Vui lòng nhập chi tiết',
                        }
                    }
                });
            });
        </script>
        <?php
        $nameErr = $preview_textErr = $detail_textErr = "";
        if (isset($_POST['submit'])) {
            $name = $_POST['name'];
            $cat_id = $_POST['cat_id'];
            $picture = $_FILES['picture']['name'];
            $preview_text = $_POST['preview_text'];
            $detail_text = $_POST['detail_text'];

            // Kiểm tra
            // name
            if ($name == "") {
                $nameErr = "Vui lòng nhập tên truyện";
            } else {
                $qrCheckname = "SELECT story.*,cat.name AS cname FROM story INNER JOIN cat ON story.cat_id = cat.cat_id WHERE story.name ='{$name}' && cat.cat_id = {$cat_id}";
                $resultCheck = $conn->query($qrCheckname);
                $arCheck = $resultCheck->fetch_assoc();
                if ($resultCheck->num_rows > 0) {
                    $nameErr = "Tên truyện đã tồn tại ở danh mục <b>{$arCheck['cname']}</b>";
                }
            }
            // Preview_text
            if ($preview_text == "") {
                $preview_textErr = "Vui lòng nhập mô tả";
            }
            // Detail_text
            if ($detail_text == "") {
                $detail_textErr = "Vui lòng nhập chi tiết";
            }
            if ($nameErr == "" && $preview_textErr == "" && $detail_textErr == "") {
                if ($picture) {
                    // Thêm truyện có hình
                    // upload ảnh
                    $tmp_name = $_FILES['picture']['tmp_name'];
                    $tmp = explode(".", $picture);
                    $file_extension = end($tmp);
                    $newName = "VNE - " . time() . '.' . $file_extension;
                    $path_upload = $_SERVER['DOCUMENT_ROOT'] . '/files/' . $newName;
                    move_uploaded_file($tmp_name, $path_upload);
                    // thực hiên câu truy vấn
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $datetime = date('Y:m:d H:i:s');
                    $qr2 = "INSERT INTO story(name,preview_text,detail_text,created_at,cat_id,picture,counter)
                            VALUES ('$name','$preview_text','$detail_text','$datetime','$cat_id','$newName',0)";
                    $result2 = $conn->query($qr2);
                    if ($result2) {
                        header('location:index.php?msg=Thêm truyện thành công');
                        die();
                    } else {
                        echo '<span style="color:red;font-style:italic;">Có lỗi khi thêm truyện</span>';
                        unlink($path_upload);
                    }
                } else {
                    // thêm truyện không có hình
                    // thực hiên câu truy vấn
                    date_default_timezone_set('Asia/Ho_Chi_Minh');
                    $datetime = date('Y:m:d H:i:s');
                    $qr2 = "INSERT INTO story(name,preview_text,detail_text,created_at,cat_id,counter)
                            VALUES ('$name','$preview_text','$detail_text','$datetime','$cat_id',0)";
                    $result2 = $conn->query($qr2);
                    if ($result2) {
                        header('location:index.php?msg=Thêm truyện thành công');
                        die();
                    } else {
                        echo '<span style="color:red;font-style:italic;">Có lỗi khi thêm truyện</span>';
                    }
                }
            }
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <!-- Form Elements -->
                <div class="panel panel-default">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">

                                <form role="form" action="" method="post" enctype="multipart/form-data" class="formAddStory">
                                    <div class="form-group">
                                        <label>Tên truyện</label>
                                        <input type="text" name="name" class="form-control" />
                                        <span class="error"><?php echo $nameErr; ?></span>
                                    </div>

                                    <div class="form-group">
                                        <label>Danh mục truyện</label>

                                        <select name="cat_id" class="form-control">
                                            <?php
                                            $qr = "SELECT * FROM cat ";
                                            $result = $conn->query($qr);
                                            while ($arItem = $result->fetch_assoc()) {
                                            ?>
                                                <option value="<?php echo $arItem['cat_id']; ?>"><?php echo $arItem['name']; ?></option>
                                            <?php
                                            }
                                            ?>
                                        </select>
                                    </div>
                                    <!-- <div class="form-group">
                                        <label>Hình ảnh</label>
                                        <input type="file" name="picture" />
                                    </div> -->
                                    <div class="form-group">
                                        <label style="display:block">Hình ảnh</label>
                                        <label for="picture" style="font-weight:500;padding:0px 4px;border: 1px solid #000;border-radius:5px;background-color:#eee;color:#000;cursor:pointer;">Tải ảnh lên</label>
                                        <input type="file" name="picture" id="picture" style="display:none" onchange="previewImage()" />
                                        <div id="preview-div">
                                            <img src="" alt="" id="preview-img">
                                            <i class="fa fa-times icon_close_img" aria-hidden="true" onclick=removeImage()></i>
                                        </div>
                                        <style>
                                            #preview-div {
                                                position: relative;
                                                width: 100px;
                                                height: 100px;
                                                display: none;
                                            }

                                            #preview-div .icon_close_img {
                                                position: absolute;
                                                top: 2px;
                                                right: 2px;
                                                color: red;
                                                font-weight: 200;
                                                cursor: pointer;
                                                transition: all 0.2s ease;
                                            }

                                            #preview-div .icon_close_img:hover {
                                                transform: rotate(180deg);
                                            }

                                            #preview-div #preview-img {
                                                margin-top: 12px;
                                                width: 100px;
                                                height: 100px;
                                                object-fit: cover;
                                                display: block;
                                            }

                                            .active-preview {
                                                display: block !important;
                                            }

                                            .error{
                                                color: red;
                                                font-style: italic;
                                                margin-left: 4px;
                                                margin-top: 4px;
                                                display: block;
                                                font-weight: normal !important;
                                            }
                                        </style>
                                        <script type="text/javascript">
                                            function previewImage() {
                                                var file = document.getElementById("picture").files;
                                                if (file.length > 0) {
                                                    var fileReader = new FileReader();

                                                    fileReader.onload = function(event) {
                                                        document.getElementById("preview-img").setAttribute("src", event.target.result);
                                                        document.getElementById("preview-div").classList.add("active-preview");
                                                        document.querySelector("label[for='picture']").innerHTML = 'Thay đổi';
                                                    };

                                                    fileReader.readAsDataURL(file[0]);
                                                }
                                            }

                                            function removeImage() {
                                                document.getElementById("picture").value = "";
                                                document.getElementById("preview-div").classList.remove("active-preview");
                                                document.querySelector("label[for='picture']").innerHTML = 'Tải ảnh lên';

                                            }
                                        </script>

                                    </div>

                                    <div class="form-group">
                                        <label>Mô tả</label>
                                        <textarea class="form-control" rows="3" name="preview_text"></textarea>
                                        <span class="error"><?php echo $preview_textErr; ?></span>
                                    </div>
                                    <div class="form-group">
                                        <label>Chi tiết</label>
                                        <textarea id="editor1" class="form-control " rows="5" name="detail_text"></textarea>
                                        <script type="text/javascript">
                                            CKEDITOR.replace('editor1', {
                                                filebrowserBrowseUrl: '/templates/admin/assets/js/ckfinder/ckfinder.html',
                                                filebrowserImageBrowseUrl: '/templates/admin/assets/js/ckfinder/ckfinder.html?type=Images',
                                                filebrowserUploadUrl: '/templates/admin/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files',
                                                filebrowserImageUploadUrl: '/templates/admin/assets/js/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images'
                                            });
                                        </script>
                                        <span class="error"><?php echo $detail_textErr; ?></span>
                                    </div>


                                    <button type="submit" name="submit" class="btn btn-success btn-md">Thêm</button>

                                </form>



                            </div>

                        </div>
                    </div>
                </div>
                <!-- End Form Elements -->
            </div>
        </div>
        <!-- /. ROW  -->
    </div>
    <!-- /. PAGE INNER  -->
</div>
<!-- /. PAGE WRAPPER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>
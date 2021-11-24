<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/header.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/Util/checkUser.php'; ?>
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/leftbar.php'; ?>
<script type="text/javascript">
    document.title = "User | VinaEnter Edu";
</script>
<div id="page-wrapper">
    <div id="page-inner">
        <div class="row">
            <div class="col-md-12">
                <h2>Quản lý người dùng</h2>
            </div>
        </div>
        <!-- /. ROW  -->
        <hr />
        <!-- Thông báo msg -->
        <?php
        if (isset($_GET['msg'])) {
        ?>
            <script type="text/javascript">
                alert('<?php echo $_GET['msg']; ?>');
            </script>
        <?php
        }
        ?>
        <div class="row">
            <div class="col-md-12">
                <!-- Advanced Tables -->
                <div class="panel panel-default">
                    <div class="panel-body">

                        <div class="table-responsive">
                            <div class="row">
                                <div class="col-sm-7">
                                    <a href="add.php" class="btn btn-success btn-md">Thêm</a>
                                </div>
                                <div class="col-sm-5" style="text-align: right;">
                                    <!-- start find -->
                                    <?php
                                    if (isset($_GET['key'])) {
                                        $find = trim($_GET['key']);
                                    }
                                    ?>
                                    <form method="get" action="?timkiem" class="form_search">
                                        <input value="<?php if (isset($_GET['key'])) {
                                                            echo $_GET['key'];
                                                        } ?>" type="search" name="key" class="form-control input-sm input_search" placeholder="Nội dung tìm kiếm..." />
                                        <label class="fa fa-search search"></label>
                                    </form>
                                    <style>
                                        .form_search {
                                            position: relative;
                                            margin-bottom: 12px;
                                        }

                                        .search {
                                            position: absolute;
                                            left: 20px;
                                            top: 50%;
                                            transform: translateY(-50%);
                                            font-size: 15px;
                                            font-weight: normal;
                                            cursor: pointer;
                                            color: #ccc;
                                            transition: color 0.2s linear;
                                        }

                                        .header_story {
                                            /* margin-top: 12px; */
                                            display: flex;
                                            align-items: center;
                                        }

                                        .input_search {
                                            padding: 8px 12px 8px 48px;
                                            border: 1px solid #ccc;
                                            outline: none;
                                            font-size: 15px;
                                            color: #000;

                                        }

                                        .input_search:focus~.search {
                                            color: #000;
                                        }
                                    </style>
                                </div>
                            </div>
                            <!--start pagination -->
                            <?php
                            //Tổng số dòng
                            if (!isset($find)) {
                                $qrTsd = "SELECT * FROM users";
                            } else {
                                $qrTsd = "SELECT * FROM users WHERE username LIKE '%$find%' OR fullname LIKE '%$find%'";
                            }
                            $resultTsd = $conn->query($qrTsd);
                            $Tsd = $resultTsd->num_rows;
                            //Số truyện trong 1 trang 
                            $row_count = ROW_COUNT;
                            //Tổng số trang
                            $Tst = ceil($Tsd / $row_count);
                            //Trang hiện tại
                            $current_page = 1;
                            if (isset($_GET['page'])) {
                                $current_page = $_GET['page'];
                            }
                            //offset
                            $offset = ($current_page - 1) * $row_count;
                            ?>
                            <!--end pagination -->
                            <?php
                            if ($Tsd == 0 && !empty($find)) {
                                echo "Không tìm thấy kết quả nào phù hợp với từ khoá:  <strong>$find</strong> ";
                            } elseif ($Tsd == 0 && !isset($find)) {
                                echo "Danh mục trống";
                            } else {
                            ?>
                                <table class="table table-striped table-bordered table-hover" id="dataTables-example">
                                    <?php
                                    if ($Tsd != 0) {
                                    ?>
                                        <thead>
                                            <tr>
                                                <th>ID</th>
                                                <th>Username</th>
                                                <th>Fullname</th>
                                                <th width="160px">Chức năng</th>
                                            </tr>
                                        </thead>
                                    <?php
                                    }
                                    ?>
                                    <tbody>
                                        <?php
                                        if (!isset($find)) {
                                            $qr = "SELECT * FROM users LIMIT {$offset},{$row_count}";
                                        } else {
                                            $qr = "SELECT * FROM users WHERE username LIKE '%$find%' OR fullname LIKE '%$find%' LIMIT {$offset},{$row_count}";
                                        }
                                        $result = $conn->query($qr);
                                        while ($row = $result->fetch_assoc()) {
                                        ?>
                                            <tr class="gradeX">
                                                <td><?php echo $row['user_id']; ?></td>
                                                <td><?php echo $row['username']; ?></td>
                                                <td><?php echo $row['fullname']; ?></td>
                                                <td class="center">
                                                    <?php
                                                    if ($_SESSION['UserAdmin']['username'] == 'admin' ||  $row['username'] != 'admin') {
                                                    ?>
                                                        <a href="edit.php?id=<?php echo $row['user_id']; ?>" title="" class="btn btn-primary"><i class="fa fa-edit "></i> Sửa</a>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($row['username'] != 'admin') {
                                                    ?>
                                                        <a href="del.php?id=<?php echo $row['user_id']; ?>" title="" class="btn btn-danger"><i class="fa fa-pencil"></i> Xóa</a>
                                                    <?php
                                                    }
                                                    ?>
                                                </td>
                                            </tr>
                                        <?php
                                        }
                                        ?>
                                    </tbody>
                                </table>
                            <?php
                            }
                            ?>
                            <div class="row">
                                <div class="col-sm-6">

                                </div>
                                <?php
                                if ($Tst >= 2) {
                                ?>
                                    <div class="col-sm-6" style="text-align: right;">
                                        <div class="dataTables_paginate paging_simple_numbers" id="dataTables-example_paginate">
                                            <?php
                                            if (isset($find)) {
                                            ?>
                                                <ul class="pagination">
                                                    <?php
                                                    if ($current_page > 3) {
                                                        $first_page = 1;
                                                    ?>
                                                        <li class="paginate_button"><a href="?key=<?php echo $find; ?>&page=<?php echo $first_page; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($current_page > 1) {
                                                        $pre_page = $current_page - 1;
                                                    ?>
                                                        <li class="paginate_button"><a href="?key=<?php echo $find; ?>&page=<?php echo $pre_page; ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    for ($i = 1; $i <= $Tst; $i++) {
                                                        if ($i != $current_page) {
                                                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                                    ?>
                                                                <li class="paginate_button"><a href="?key=<?php echo $find; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <li class="paginate_button active"><a href="?key=<?php echo $find; ?>&page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($current_page < $Tst) {
                                                        $next_page = $current_page + 1;
                                                    ?>
                                                        <li class="paginate_button"><a href="?key=<?php echo $find; ?>&page=<?php echo $next_page; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($current_page < $Tst - 2) {
                                                        $end_page = $Tst;
                                                    ?>
                                                        <li class="paginate_button"><a href="?key=<?php echo $find; ?>&page=<?php echo $next_page; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            <?php
                                            } else {
                                            ?>
                                                <ul class="pagination">
                                                    <?php
                                                    if ($current_page > 3) {
                                                        $first_page = 1;
                                                    ?>
                                                        <li class="paginate_button"><a href="?page=<?php echo $first_page; ?>"><i class="fa fa-angle-double-left" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($current_page > 1) {
                                                        $pre_page = $current_page - 1;
                                                    ?>
                                                        <li class="paginate_button"><a href="?page=<?php echo $pre_page; ?>"><i class="fa fa-angle-left" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    for ($i = 1; $i <= $Tst; $i++) {
                                                        if ($i != $current_page) {
                                                            if ($i > $current_page - 3 && $i < $current_page + 3) {
                                                    ?>
                                                                <li class="paginate_button"><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                            <?php
                                                            }
                                                        } else {
                                                            ?>
                                                            <li class="paginate_button active"><a href="?page=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                                                    <?php
                                                        }
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($current_page < $Tst) {
                                                        $next_page = $current_page + 1;
                                                    ?>
                                                        <li class="paginate_button"><a href="?page=<?php echo $next_page; ?>"><i class="fa fa-angle-right" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                    <?php
                                                    if ($current_page < $Tst - 2) {
                                                        $end_page = $Tst;
                                                    ?>
                                                        <li class="paginate_button"><a href="?page=<?php echo $Tst; ?>"><i class="fa fa-angle-double-right" aria-hidden="true"></i></a></li>
                                                    <?php
                                                    }
                                                    ?>
                                                </ul>
                                            <?php
                                            }
                                            ?>
                                        </div>
                                    </div>
                                <?php
                                }
                                ?>
                            </div>
                        </div>

                    </div>
                </div>
                <!--End Advanced Tables -->
            </div>
        </div>
    </div>

</div>
<!-- /. PAGE INNER  -->
<?php require_once $_SERVER['DOCUMENT_ROOT'] . '/templates/admin/inc/footer.php'; ?>
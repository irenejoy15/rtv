<style>
    span.select2-selection.select2-selection--single {
      height:100% !important;
    }
    .select2-container--default .select2-selection--single .select2-selection__arrow {
      height: 40px;
      position: absolute;
      top: 1px;
      right: 1px;
      width: 20px;
    }
</style>
<!-- Content Header (Page header) -->
<div class="content-header">
  <div class="container-fluid">
    <div class="row mb-2">
      <div class="col-md-6 col-sm-12">
        <h1 class="m-0">EDIT USER</h1>
      </div><!-- /.col -->
      <div class="col-md-6 col-sm-12" style="font-size: 20px;">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/dashboard">HOME</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/user">USERS</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/user/edit/<?php echo $user->user_uuid;?>">EDIT</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-sm-12 col-md-12 col-lg-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url();?>assets/dist/img/user2.png"
                       alt="User profile picture">
                </div>

                <h3 class="profile-username text-center mt-4">USER</h3>
                <p class="text-muted text-center"><span id="firstname"><?php echo $user->first_name;?></span> <span id="middlename"><?php echo $user->middle_name;?></span> <span id="lastname"><?php echo $user->last_name;?></span></p>
                <!-- <p class="text-muted text-center">IT DEPARTMENT</p> -->

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-sm-12 col-md-12 col-lg-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active">EDIT</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div>
                    <?php $attributes = array('id'=>'user_register','class'=>'form'); ?>
                    <?php echo form_open('user/update/'.$user->user_uuid, $attributes);?>
                    <div class="form-group row">
                        <label for="first_name" class="col-sm-2 col-form-label">First Name:</label>
                        <div class="col-sm-10">
                            <?php
                            $firstname = array(
                            'class'=>'form-control textbox',
                            'name'=>'first_name',
                            'required'=>'required',
                            'onkeypress'=>'return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode >= 8 && event.charCode <= 9)',
                            'placeholder'=>'Enter Your First Name',
                            'id'=>'first_name',
                            'onkeyup'=>'firstname()',
                            'value'=>$user->first_name
                            );
                            ?>
                            <?php echo form_input($firstname);?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="middle_name" class="col-sm-2 col-form-label">Middle Name:</label>
                        <div class="col-sm-10">
                            <?php
                            $middle_name = array(
                            'class'=>'form-control textbox',
                            'name'=>'middle_name',
                            'onkeypress'=>'return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode >= 8 && event.charCode <= 9)',
                            'placeholder'=>'Enter Your Middle Name',
                            'id'=>'middle_name',
                            'onkeyup'=>'middlename()',
                            'value'=>$user->middle_name
                            );
                            ?>
                            <?php echo form_input($middle_name);?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="last_name" class="col-sm-2 col-form-label">Last Name:</label>
                        <div class="col-sm-10">
                            <?php
                            $last_name = array(
                            'class'=>'form-control textbox',
                            'name'=>'last_name',
                            'required'=>'required',
                            'onkeypress'=>'return (event.charCode > 64 && event.charCode < 91) || (event.charCode > 96 && event.charCode < 123) || (event.charCode == 32) || (event.charCode >= 8 && event.charCode <= 9)',
                            'placeholder'=>'Enter Your Last Name',
                            'id'=>'last_name',
                            'onkeyup'=>'lastname()',
                            'value'=>$user->last_name
                            );
                            ?>
                            <?php echo form_input($last_name);?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="location_code" class="col-sm-2 col-form-label">User Type:</label>
                        <div class="col-sm-10">
                          <select id="user" required="required" name="usertype_id" class="form-control select2 select2-primary" data-dropdown-css-class="select2-primary" style="width: 100%; height:200px;">
                            <?php foreach($usertypes as $usertype):?>
                              <?php if($usertype->id==$user->usertype_id):?>
                                <option selected="selected" value="<?php echo $usertype->id;?>"><?php echo $usertype->type_name;?></option>
                              <?php else:?>
                                <option value="<?php echo $usertype->id;?>"><?php echo $usertype->type_name;?></option>
                              <?php endif;?>
                            <?php endforeach;?>
                          </select>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="email" class="col-sm-2 col-form-label">Username:</label>
                        <div class="col-sm-10">
                            <input type="text" disabled="disabled" class="form-control" id="email" name="email" required="required" placeholder="Enter Your Username" value="<?php echo $user->email;?>">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="updateemail" class="col-sm-2 col-form-label">Update Username:</label>
                        <div class="col-sm-10">
                            <input onclick="emailCheck()" id="updateemail" style="margin-left:10px; margin-top:13px; position:absolute;" type="checkbox" name="updateemail" value="1">
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" name="password" class="col-sm-2 col-form-label">Password:</label>
                        <div class="col-sm-10">
                            <?php
                                $password = array(
                                'class'=>'form-control textbox',
                                'name'=>'password',
                                'placeholder'=>'Enter your password',
                                'id'=>'password'
                                );
                                ?>
                                <?php echo form_password($password);?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Superuser:</label>
                        <div class="col-sm-10 pt-2">
                        <?php if($user->superuser=='1'):?>
                            <input checked="checked" style="margin-left:10px; margin-top:6px; position:absolute;" type="checkbox" name="superuser" value="1">
                        <?php else:?>
                            <input style="margin-left:10px; margin-top:6px; position:absolute;" type="checkbox" name="superuser" value="1">
                        <?php endif;?>
                        </div>
                    </div>
                      
                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Excel Uploader:</label>
                        <div class="col-sm-10 pt-2">
                        <?php if($user->excel_upload_status=='1'):?>
                          <input checked="checked" style="margin-left:10px; margin-top:6px; position:absolute;" type="checkbox" name="excel_status" value="1">
                        <?php else:?>
                          <input style="margin-left:10px; margin-top:6px; position:absolute;" type="checkbox" name="excel_status" value="1">
                        <?php endif;?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Migrator:</label>
                        <div class="col-sm-10 pt-2">
                        <?php if($user->migration_upload_status=='1'):?>
                          <input checked="checked" style="margin-left:10px; margin-top:6px; position:absolute;" type="checkbox" name="migration_uploader" value="1">
                        <?php else:?>
                          <input style="margin-left:10px; margin-top:6px; position:absolute;" type="checkbox" name="migration_uploader" value="1">
                        <?php endif;?>
                        </div>
                    </div>

                    <div class="form-group row">
                        <label for="enabled" class="col-sm-2 col-form-label">Enabled:</label>
                        <div class="col-sm-10 pt-2">
                        <?php if($user->enabled=='1'):?>
                            <input style="margin-left:10px; margin-top:6px; position:absolute;" checked="checked" type="checkbox" name="enabled" value="1">
                        <?php else:?>
                            <input style="margin-left:10px; margin-top:6px; position:absolute;" type="checkbox" name="enabled" value="1">
                        <?php endif;?>
                        </div>
                    </div>


                      <div class="form-group row">
                        <div class="offset-sm-2 col-sm-10">
                            <?php
                              $data = array(
                              'class'=>'btn btn-success btn-block',
                              'name'=>'create user',
                              'value'=>'UPDATE USER'
                              );
                              ?>
                            <?php echo form_submit($data);?>
                        </div>
                      </div>
                    <?php echo form_close();?>
                  </div>
                  <!-- /.tab-pane -->
                </div>
                <!-- /.tab-content -->
              </div><!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div><!-- /.container-fluid -->
    </section>
    <script type="text/javascript">
        function firstname() {
            document.getElementById("firstname").innerHTML = document.getElementById("first_name").value;
        }

        function middlename() {
            document.getElementById("middlename").innerHTML = document.getElementById("middle_name").value;
        }

        function lastname() {
            document.getElementById("lastname").innerHTML = document.getElementById("last_name").value;
        }

        function emailCheck()
        {

            if(document.getElementById('updateemail').checked)
                document.getElementById('email').disabled = false;
            else
                document.getElementById('email').disabled = true;
        }
    </script>

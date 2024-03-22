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
        <h1 class="m-0">SETTINGS</h1>
      </div><!-- /.col -->
      <div class="col-md-6 col-sm-12" style="font-size: 20px;">
        <ol class="breadcrumb float-sm-right">
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/dashboard">HOME</a></li>
          <li class="breadcrumb-item"><a style="color:#869099;" href="<?php echo base_url();?>index.php/account">SETTINGS</a></li>
        </ol>
      </div><!-- /.col -->
    </div><!-- /.row -->
  </div><!-- /.container-fluid -->
</div>
<!-- /.content-header -->

<section class="content">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-3">

            <!-- Profile Image -->
            <div class="card card-primary card-outline">
              <div class="card-body box-profile">
                <div class="text-center">
                  <img class="profile-user-img img-fluid img-circle"
                       src="<?php echo base_url();?>assets/dist/img/user2.png"
                       alt="User profile picture">
                </div>


                <h3 class="profile-username text-center mt-4">
                  PROFILE
                </h3>

                <p class="text-muted text-center"><?php echo $this->session->userdata('first_name');?> <?php echo $this->session->userdata('last_name');?></p>

              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
          <div class="col-md-9">
            <div class="card">
              <div class="card-header p-2">
                <ul class="nav nav-pills">
                  <li class="nav-item"><a class="nav-link active">Settings</a></li>
                </ul>
              </div><!-- /.card-header -->
              <div class="card-body">
                <div class="tab-content">
                  <div>
                    <?php $attributes = array('id'=>'user_register','class'=>'form'); ?>
                    <?php echo form_open('account/update/'.$this->session->userdata('user_uuid'), $attributes);?>
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
                            'value'=>trim($this->session->userdata('first_name'))
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
                            'value'=>trim($this->session->userdata('middle_name'))
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
                            'value'=>trim($this->session->userdata('last_name'))
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
                                <?php if($usertype->id==$this->session->userdata('usertype')):?>
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
                            <input type="text" disabled="disabled" class="form-control" id="email" name="email" required="required" placeholder="Enter Your Username" value="<?php echo $this->session->userdata('email');?>">
                        </div>
                      </div>

                      <div class="form-group row">
                          <label for="updateemail" class="col-sm-2 col-form-label">Update Username:</label>
                          <div class="col-sm-10">
                              <input onclick="emailCheck()" id="updateemail" style="margin-left:10px; margin-top:13px; position:absolute;" type="checkbox" name="updateemail" value="1">
                          </div>
                      </div>

                      <div class="form-group row">
                        <label for="password" class="col-sm-2 col-form-label">Password:</label>
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
                        <div class="offset-sm-2 col-sm-10">
                            <?php
                              $data = array(
                              'class'=>'btn btn-success btn-block',
                              'name'=>'update_setting',
                              'value'=>'Update Your Details'
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

    <script>
      function emailCheck()
        {

            if(document.getElementById('updateemail').checked)
                document.getElementById('email').disabled = false;
            else
                document.getElementById('email').disabled = true;
        }
    </script>

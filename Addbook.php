<?php
session_start();
if (!isset($_SESSION['astatus'])) {
    header("location:./index.php");
}
include("./includes/head.php"); ?>
<div class="main-wrapper">
  <?php include("./includes/navbar.php"); ?>
  <?php include("./includes/sidebar.php"); ?>

  <div class="page-wrapper">
    <div class="content">
      <div class="card">
        <div class="card-body">
          <div class="row">
            <form action="./query/uploadingnotes.php" class="needs-validation" method="post"
              enctype="multipart/form-data" novalidate>
              <div class="col-lg-6 col-sm-6 col-12 d-flex ">
                <div class="form-group form-validate col-8">
                  <label>Subject Name <span style="color:red;">*</span></label>
                  <input type="text" name="notename" class="form-control" required>
                  <div class="valid-feedback">
                    good!
                  </div>
                </div>
                <div class="form-group  form-validate col-4 " style="margin-left:80px; text-align:center;">
                  <label>Note Type<span style="color:red;">*</span></label>
                  <select class="form-select" name="notetype" id="" required>
                    <option value="">-----SELECT-----</option>
                    <option value="Question Paper">Question Paper</option>
                    <option value="Notes">Notes</option>
                    <option value="Solution">Solution</option>
                  </select>
                </div>
              </div>


              <div class="col-lg-12">
                <div class="form-group">
                  <label class="form-label">Description</label>
                  <textarea class="form-control" name="notedes"></textarea>
                </div>
              </div>
              <div class="col-lg-6 d-flex ">
                <div class="form-group col-sm-6 col-6 ">
                  <label for="programs">Program<span style="color:red;">*</span></label>
                  <select name="program" class="form-select" id="programs" required>
                    <option value="">-----SELECT-----</option>
                    <?php
                                        include("./includes/conn.php");
                                        $sql = "SELECT * FROM `program`";
                                        $exsql = mysqli_query($conn, $sql);
                                        while ($row = mysqli_fetch_assoc($exsql)) {
                                        ?>
                    <option value='<?php echo $row['program_name']; ?>'>
                      <?php echo $row['program_name']; ?>
                    </option>
                    <?php } ?>
                  </select>
                </div>
                <div class="col-lg-6 col-6">
                  <div class="form-group col-sm-6 ">
                    <label for="semesters">Semester<span style="color:red;">*</span></label>
                    <select name="semester" class="form-select" id="semesters" required>
                      <option value="">-----SELECT-----</option>
                      <?php
                                            include("./includes/conn.php");
                                            $sql = "SELECT * FROM `semester`";
                                            $exsql = mysqli_query($conn, $sql);
                                            while ($row = mysqli_fetch_assoc($exsql)) {
                                            ?>
                      <option value='<?php echo $row['semester_name']; ?>'>
                        <?php echo $row['semester_name']; ?>
                      </option>
                      <?php } ?>
                    </select>
                  </div>
                </div>
                <div class="form-group form-validate col-8">
                  <label>Downloading Name<span style="color:red;">*</span></label>
                  <input type="text" name="dname" class="form-control" placeholder="Download" required>
                  <div class="valid-feedback">
                    good!
                  </div>
                </div>
              </div>
              <div class="col-lg-12 d-flex">
                <div class="form-group">
                  <label id="files">Uploading Note<span style="color:red;">*</span></label>
                  <div class="image-upload">
                    <div class="image-uploads">
                      <input type="file" class="form-control" name="file" id="pdf-file" id="pdf-file"
                        accept=".pdf,.png ,.jpg" onchange="uploadPDF()" required />
                      <img src="assets/img/icons/upload.svg" id="default-btn" alt="img">
                      <h4>File to upload</h4>
                    </div>
                    <div class="invalid-feedback">Please Select uploading file</div>
                  </div>
                </div>
                <div class="form-group " id="main">


                  <div id="pdf-viewer"></div>

                </div>
              </div>
              <div class="col-lg-12 uploadbtn ">
                <input class="btn btn-submit me-2" type="submit" name="submit" value="Upload" />
                <input class="btn btn-cancel " type="reset" value="Cancel" />
              </div>
            </form>
            <style>
            #main {
              margin-left: 150px;
              width: 70%;
              height: 870px;
              margin-top: 3rem;
              border-radius: 20px;
            }

            .col-6 {
              flex: 0 0 auto;

            }

            .form-select {
              width: unset !important;
            }

            .uploadbtn {
              margin-top: -15rem;
              padding-bottom: 3rem;
              padding-left: 3rem;
            }

            #default-btn {
              margin-top: -50px;
            }

            #bannerimg {

              position: relative;
            }

            #overfile {
              position: absolute;

              cursor: pointer;

            }

            .fas {
              cursor: pointer;

            }
            </style>

            <script>
            // Form Validation 

            (() => {
              'use strict'

              // Fetch all the forms we want to apply custom Bootstrap validation styles to
              const forms = document.querySelectorAll('.needs-validation')

              // Loop over them and prevent submission
              Array.from(forms).forEach(form => {
                const first = form.addEventListener('submit', event => {
                  if (!form.checkValidity()) {
                    event.preventDefault()
                    event.stopPropagation()
                  }

                  form.classList.add('was-validated');


                }, false)
              })
            })()


            //For PDF Uploading

            function uploadPDF() {
              var input = document.getElementById('pdf-file');

              if (!input.files || !input.files[0]) {
                alert('Please select a PDF file.');
                return;
              }

              var file = input.files[0];
              var reader = new FileReader();

              reader.onload = function(e) {
                var pdfData = e.target.result;

                // Display PDF
                displayPDF(pdfData);
              };

              reader.readAsDataURL(file);
            }

            function displayPDF(pdfData) {
              var pdfViewer = document.getElementById('pdf-viewer');

              // Clear previous content
              pdfViewer.innerHTML = '';

              // Create <embed> tag to display PDF
              var embed = document.createElement('embed');
              embed.src = pdfData;
              embed.type = 'application/pdf';
              embed.width = '100%';
              embed.height = '600px';

              pdfViewer.appendChild(embed);
            }
            </script>
          </div>
        </div>
      </div>


    </div>
  </div>
</div>


<?php include("./includes/footer.php"); ?>
<?php include 'classes/functions.php'; ?>
<?php include 'header.php'; ?>

      <div class="row">
        <div class="col-lg-12">
          <h1>All Files</h1>
          <p>Here is the list of files available to our employees. You can download the files or upload new files.</p>
          <table class="table table-striped table-hover">
            <thead>
              <tr>
                <th width="5%">#</th>
                <th width="60%">File Name</th>
                <th width="20%">File Size</th>
                <th width="15%"></th>
              </tr>
            </thead>
            <tbody>



      <?php 
            $dirlist = getFileList("./files/");
            $i=0;
            foreach($dirlist as $file) {
              $i++;
      ?>
              <tr>
                <td><?php echo $i; ?></td>
                <td>
                  <a href="<?php echo $file['name']; ?>"><?php echo basename($file['name']); ?></a>
                </td>
                <td><?php echo $file['size']; ?> Bytes</td>
                <td></td>
              </tr>
      <?php 

            }
      ?>
            </tbody>
          </table>
        </div>
      </div>

<?php include 'footer.php'; ?>

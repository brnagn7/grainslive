<?php include('inc/header.html'); ?>
    <!-- Page Content -->
    <div class="container">
        <!-- Page Heading/Breadcrumbs -->
        <div class="row">
            <div class="col-lg-12">
                <h1 class="page-header">Local System Administration
                    <small>Linux</small>
                </h1>
            </div>
        </div>
        <!-- /.row -->
        <div class="panel panel-danger">
  <ul class="nav nav-tabs">
    <li class="active"><a data-toggle="tab" href="#home">Administration</a></li>
    <li><a data-toggle="tab" href="#backups">Backups</a></li>
    <li><a data-toggle="tab" href="#users">Users</a></li>
    <li><a data-toggle="tab" href="#groups">Groups</a></li>
    <li><a data-toggle="tab" href="#files">Files</a></li>
    <li><a data-toggle="tab" href="#mounts">Mounts</a></li>
  </ul>

  <div class="tab-content">
    <div id="home" class="tab-pane fade in active">
      <h3>Local System Administration</h3>
      <p>This section is the main entry point for <strong>System Administration</strong> where you will find a nice collection of tasks that are essential for any Administrator. I have here only that which scratches the surface, there are so many usefull websites online today that it really is very easy to pick up and learn Linux in no time.</p>
                        <p>
                            It is inevitable that equipment will fail, and files get delted all the time, it's your job to make sure your user's files can be restored if anything bad happens. There is a danger when removing files though, so be careful. Suppose you are cleaning out the system and prior to that you had switched to the root account. You have just a few more things to do, let's say you change to a user's home directory and you type this by mistake.
                            <br />
                            <code>rm -r *</code>, crazy I know, probably won't happen right? But suppose it did. You just deleted all the files in the user's home directory without the option to confirm.
                            <p>
                                So in this section we will look at <strong>Backups</strong> and see just how easy they are.
                            </p>
    </div>
    <div id="backups" class="tab-pane fade">
<h3>Creating Backups</h3>
<table class="table table-striped, table-bordered">
    <thead><tr class="danger"><th width="50%">Task Required</th><th width="50">Commands and Details</th></tr>
    </thead>
    <tr><td>You want to Create a compressed tar archive of all the files under <code>/home/neo</code> with the highest level directory being <strong>neo</strong>. This is important so that the user 'Neo' is covered. In this example, we have a backup directory located on the root drive that has been mounted. It is not a good idea to keep backup's on the same machine for obvious reasons, so we have mounted an external hard drive large enough to do the job and placed the relevant entries into <code>/etc/fstab</code>
    <p>
    <pre>/backup</pre> You would like to place Neo's backup there.
  </p>
    </td>
    <td><pre>
        $ cd /backup
        $ tar -C /home -zcf neo.tar.gz neo
    </pre>
        In the above example, the <code>-C</code> flag means, configure tar to <strong>change to the /home directory</strong> and from there, tar will backup Neo's home folder as it were and you will have a 'tar' archive in the <code>/backup/</code> directory.
        <br />The options I have used are:
        <ul>
            <li>z for gzip compression</li>
            <li>c for create</li>
            <li>f for filename</li>
        </ul>
        Options for compression with tar include:
        <br />
        <ul>
            <li>z for gzip compression</li>
            <li>j for bzip2 compression</li>
            <li>J for xz compression</li>
        </ul>
        Here are the results, you can see below that the best compression is from <code>-J</code> and <code>xz compression</code>
        <br />
            <pre>$ ls -lsh
        2.1M -rw-rw-r-- 1 user user 2.1M Jan 20 19:03 neo.tar.bz
        2.6M -rw-rw-r-- 1 user user 2.6M Jan 20 18:59 neo.tar.gz
        1.8M -rw-rw-r-- 1 user user 1.8M Jan 20 19:04 neo.tar.xz</pre>
    </td>
    </tr>
    <thead><tr class="danger"><th width="50%">Task Required</th><th width="50">Commands and Details</th></tr>
</table>
    </div>
    <div id="users" class="tab-pane fade">
      <h3>Managing Users</h3>
      <p>A user's personal group should not be shared with other user's, unless you want to let other user's access his/her files. To do so you would create perhaps a separate group just for that purpose. The point is that you don't want to discourage the use of groups, rather you want to setup a more restrictive default group for user's to share files with. Bear in mind, I have not discussed the use of the <code>umask</code> command, more on this later.</p>
    <table class="table table-striped, table-bordered">
    <thead><tr class="danger"><th width="50%">Task Required</th><th width="50">Commands and Details</th></tr>
    </thead>
    <tr><td>You want to add a user account for <strong>Morphius</strong> giving him his own home directory and <code>bash</code> as his command shell. You have decided to give him an initial password and allow him to change it upon his first login.
    </td>
    <td><pre>
        $ sudo useradd -m -s /bin/bash -c "Mr Morphius Matrix" morphius
        $
        $ sudo passwd morphius
        Enter new UNIX password
        Retype new UNIX password
        passwd: password updated successfully
        $
        </pre>
        In the above example:
        <ul>
          <li>The <code>-m</code> flag means, create the user home directory</li>
          <li>The <code>-s</code> flag means, set the shell to bash</li>
          <li>The <code>-c</code> flag allows us to set a comment</li>
        </ul>
        <p>
        Looking at the password file reveals:
      </p>
        <pre>
          $ cat /etc/passwd | grep morphius
          morphius:x:5007:5007::/home/morphius:
        </pre>
        Modern systems put a placeholder for the encrypted password in <code>/etc/passwd</code>.<br />
        The password is not shown, it is represented here by the letter <strong>x</strong>. The real hashed password is found in <code>/etc/shadow</code>
        <p>
          <pre>
            $ sudo cat /etc/shadow | grep morphius
            morphius:$6$r2X6M2VU$pt4MrGL8Uarvbw.Ng6wm/AHPLgNysooSDpEH3PaS6yzq5zDDwB9rioVrnH
            Nd/OXrxVLzOyXDnEvALwZyawHw.1:16823:0:99999:7:::
          </pre>

        </p>
    </td>
    </tr>
</table>
    </div>
    <div id="groups" class="tab-pane fade">
      <h3>Managing Groups</h3>
      <p>Users belong to one or more groups and can be allowed to share a work area, set up file permissions to allow access to other group members and so on.</p>
    </div>
    <div id="files" class="tab-pane fade">
      <h3>File Management</h3>
      <p>File management is the process of basic document control. The ability to find create, delete, restrict file access.</p>
      <table class="table table-striped, table-bordered">
      <thead><tr class="danger"><th width="50%">Task Required</th><th width="50">Commands and Details</th></tr>
      </thead>
      <tr><td>You want to use the 'cut' command to remove the middle column.
      </td>
      <td><pre>
          $ cut -f 3 < column.txt
          The Linux Bible
          The Command line
          XP Professional
          Ubuntu Server
          Server 2003
          </pre>
          The file column.txt:
          <pre>
          Category    Title             Price
          Linux       The Linux Bible   $34.00
          Linux       The Command line  $23.99
          Windows     XP Professional   $12.99
          Linux       Ubuntu Server     $56.00
          Windows     Server 2003       $54.88
          </pre>
      </td>
      </tr>
  </table>
    </div>
    <div id="mounts" class="tab-pane fade">
      <h3>Mounting File Systems</h3>
      <p>Mounting disks such as USB sticks, External drives and even remote network directories all come under what's known as "mounts".</p>
    </div>
  </div>
</div>
<!-- end main div -->
</div>
        <hr>
    </div>
    <!-- /.container -->

    <!-- jQuery -->
    <script src="js/jquery.js"></script>

    <!-- Bootstrap Core JavaScript -->
    <script src="js/bootstrap.min.js"></script>
    <?php include('inc/footer.html'); ?>

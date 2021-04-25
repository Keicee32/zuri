<?php

require_once "libs/form-valid.php";

if(!isset($_SESSION['username']) && empty($_SESSION['username'])){
    header('Location: index.php');
}


?>

<?php  include_once "libs/headers/header.php" ?>

    <section>
        <div class="dashboard">
            <div class="form">
                <div class="form-user">
                    <h1>Welcome <?php echo $_SESSION['username'] ?></h1>
                </div>
                <h3>List of Registered Courses</h3>
 
                <?php if($num < 1): echo "You do not have any course registered yet. <a href='course-reg.php'>Please register a course</a>";?>

                <?php else: ?>
                    <?php foreach($courseDetails as $courseDetail): extract($courseDetail)?>
                        <table>
                            <tr>
                                <th>#</th>
                                <th>Course</th>
                                <th>Session</th>
                                <th>Department</th>
                                <th>Level</th>
                                <th>Semester</th>
                                <th>Enrollment Date</th>
                                <th>Action</th>
                            </tr>
                            
                            <tr>
                                <td><?php echo $id;?></td>
                                <td><?php echo $course;?></td>
                                <td><?php echo $years;?></td>
                                <td><?php echo $department;?></td>
                                <td><?php echo $levels;?></td>
                                <td><?php echo $semester;?></td>
                                <td><?php echo $created_at;?></td>
                                <td><button><a href="view.php?id=<?php echo $id;?>"> Edit</a></button></td>
                                <td><button><a href="delete.php?id=<?php echo $id;?>" onclick="return confirm('Are you sure you want to delete Y/N?')">Delete</a></button></td>
                            </tr>
                        </table> 
                    <?php endforeach; ?> 
                <?php endif;?>                
            </div>
        </div>
    </section>
</body>
</html>
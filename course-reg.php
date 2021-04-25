<?php 

require_once "libs/form-valid.php";

if(!isset($_SESSION['username']) && empty($_SESSION['username'])){
    header('Location: index.php');
}

?>

<?php  include_once "libs/headers/header.php" ?>

<main>
        <section class="glass">
            <div class="form-group">
                <h3>Please Register Your Course</h3>

                <?php if(count($errors) > 0): ?>
                <div class="alert alert-red">
                    <?php foreach($errors as $error): ?>
                    <li><?php echo $error ?></li>
                    <?php endforeach; ?>
                </div>
                <?php endif; ?>

                <form action="course-reg.php" method="POST">
                    <input type="text" name="course" id="" placeholder="Enter your Course Name" value="<?php echo htmlspecialchars($course);?>">
                    <input type="text" name="year" id="" placeholder="Enter Academic Year" value="<?php echo htmlspecialchars($year);?>">

                    <select name="department" id="" value="<?php echo htmlspecialchars($department);?>">
                        <option value="">Select Department</option>
                        <option value="maths">Maths</option>
                        <option value="computer science">Computer Science</option>
                        <option value="business administration">Business Administration</option>
                        <option value="yoruba">Yoruba</option>
                    </select>

                    <select name="level" id="">
                        <option value="">Select Level</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                    </select>

                    <input type="text" name="semester" id="" placeholder="Enter Semester" value="<?php echo htmlspecialchars($semester);?>">

                    <div class="btn">
                        <button name="register" type="submit">Submit</button>
                    </div>
                    
                </form>
            </div>
        </section>
    </main>
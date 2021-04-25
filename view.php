<?php

require_once "config/db.php";

if(!isset($_SESSION['username']) && empty($_SESSION['username'])){
    header('Location: index.php');
}

$id_user = isset($_GET['id']) ? $_GET['id'] : die('Error: Record not found');


$course = $year = $semester = "";

$sql = "SELECT * FROM courses WHERE id=:id";
$stmt = $conn->prepare($sql);
$stmt->bindParam(":id", $id_user);
$stmt->execute();
$details = $stmt->fetchAll(PDO::FETCH_ASSOC);



if(isset($_POST['update'])){
    $course = trim($_POST['course']);
    $year = trim($_POST['year']);
    $department = trim(ucwords($_POST['department']));
    $level = trim($_POST['level']);
    $semester = trim($_POST['semester']);

    if(empty($course)){
        $errors['course'] = "Course Name is required";
    }

    if(empty($year)){
        $errors['year'] = "Academic year is required";
    }

    if(empty($department)){
        $errors['department'] = "Department is required";
    }

    if(empty($level)){
        $errors['level'] = "Level is required";
    }

    if(empty($semester)){
        $errors['semester'] = "Semester is required";
    }

    if(empty($errors)){
        try{
            $sql = "UPDATE courses SET course=:c, years=:y, department=:d, levels=:l, semester=:s WHERE id=:id";
            $stmt = $conn->prepare($sql);

            $stmt->bindParam(":c", $course);
            $stmt->bindParam(":y", $year);
            $stmt->bindParam(":d", $department);
            $stmt->bindParam(":l", $level);
            $stmt->bindParam(":s", $semester);
            $stmt->bindParam(":id", $id_user);


            if($stmt->execute()){
                header("Location: dashboard.php");
            } else{
                echo "Not Successful";
            }
        }catch(PDOException $e){
            echo "SOMETHING WENT WRONG. CANNOT UPDATE DATABASE. " .$e->getMessage();
        }
    }
    
}

?>

<?php  include_once "libs/headers/header.php" ?>

<main>
        <section class="glass">
            <div class="form-group">
                <h3>Edit Your course</h3>


                <form action="<?php echo htmlspecialchars($_SERVER['PHP_SELF'] . "?id={$id_user}");?>" method="POST">
                    <?php foreach($details as $detail): extract($detail); ?>
                    <input type="text" name="course" id="" placeholder="Enter your Course Name" value="<?php echo htmlspecialchars($course);?>">
                    <input type="text" name="year" id="" placeholder="Enter Academic Year" value="<?php echo htmlspecialchars($years);?>">

                    <select name="department" id="">
                        <option value="<?php echo htmlspecialchars($department);?>" hidden><?php echo $department;?></option>
                        <option value="">Select Department</option>
                        <option value="maths">Maths</option>
                        <option value="computer science">Computer Science</option>
                        <option value="business administration">Business Administration</option>
                        <option value="yoruba">Yoruba</option>
                    </select>

                    <select name="level" id="">
                        <option value="<?php echo htmlspecialchars($levels);?>" hidden><?php echo $levels;?></option>
                        <option value="">Select Level</option>
                        <option value="100">100</option>
                        <option value="200">200</option>
                        <option value="300">300</option>
                        <option value="400">400</option>
                        <option value="500">500</option>
                    </select>

                    <input type="text" name="semester" id="" placeholder="Enter Semester" value="<?php echo htmlspecialchars($semester);?>">

                    <?php endforeach;?>

                    <div class="btn">
                        <button name="update" type="submit">Update</button>
                    </div>
                    
                </form>
            </div>
        </section>
    </main>
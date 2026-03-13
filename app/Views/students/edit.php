<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h2 class="mb-4">Edit Student</h2>

<div class="row">
    <div class="col-md-6">
        <div class="card">
            <div class="card-header">
                Edit Student Information
            </div>

            <div class="card-body">
                <form method="post" action="/students/update/<?= $student['id'] ?>">

                    <div class="mb-3">
                        <label class="form-label">Full Name</label>
                        <input type="text" name="fullname" value="<?= $student['fullname'] ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Email</label>
                        <input type="email" name="email" value="<?= $student['email'] ?>" class="form-control">
                    </div>

                    <div class="mb-3">
                        <label class="form-label">Course</label>
                        <input type="text" name="course" value="<?= $student['course'] ?>" class="form-control">
                    </div>

                    <button class="btn btn-success w-100">
                        Update Student
                    </button>

                </form>
            </div>

        </div>
    </div>
</div>

<?= $this->endSection() ?>
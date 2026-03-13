<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<h4 class="mb-1 fw-bold">
    Welcome, <?= session()->get('name') ?>
</h4>

<p class="text-muted mb-5">
    Manage your student records from this dashboard.
</p>

<div class="row mb-4">

    <div class="col-md-4">
        <div class="card shadow border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h6 class="text-muted">Total Students</h6>
                    <h2 class="fw-bold"><?= $totalStudents ?></h2>
                    <p class="text-muted mb-0">Registered in system</p>
                </div>
            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h6 class="text-muted">Add Student</h6>
                    <p class="text-muted">Create a new student record</p>
                </div>

                <button
                    class="btn btn-primary btn"
                    data-bs-toggle="modal"
                    data-bs-target="#addStudentModal">
                    Add Student
                </button>

            </div>
        </div>
    </div>

    <div class="col-md-4">
        <div class="card shadow border-0 h-100">
            <div class="card-body d-flex flex-column justify-content-between">
                <div>
                    <h6 class="text-muted">Student Management</h6>
                    <p class="text-muted">View and manage student records</p>
                </div>

                <a href="/students" class="btn btn-primary btn">
                    Open Students
                </a>

            </div>
        </div>
    </div>

</div>

<div class="card shadow border-0">

    <div class="card-header bg-white">
        Recent Students
    </div>

    <div class="card-body">

        <table class="table table-bordered">

            <thead class="table-dark">
                <tr>
                    <th>Full Name</th>
                    <th>Email</th>
                    <th>Course</th>
                    <th>Updated</th>
                </tr>
            </thead>

            <tbody>
                <?php foreach ($recentStudents as $row): ?>
                    <tr>
                        <td><?= $row['fullname'] ?></td>
                        <td><?= $row['email'] ?></td>
                        <td><?= $row['course'] ?></td>
                        <td>
                            <?= $row['updated_at'] 
                            ? date('F d, Y • h:i A', strtotime($row['updated_at']))
                            : 'Not updated' ?>
                        </td>
                    </tr>
                <?php endforeach ?>
            </tbody>

        </table>

    </div>

</div>

<div class="modal fade" id="addStudentModal" tabindex="-1">

    <div class="modal-dialog modal-dialog-centered">

        <div class="modal-content">

            <div class="modal-header justify-content-center">
                <h5 class="modal-title text-center w-100">
                    Add Student
                </h5>

                <button
                    type="button"
                    class="btn-close position-absolute end-0 me-3"
                    data-bs-dismiss="modal">
                </button>
            </div>

            <form action="/students/store" method="post">

                <?= csrf_field() ?>

                <div class="modal-body px-4">

                    <div class="mb-3">

                        <label class="form-label">
                            Full Name
                        </label>

                        <input
                            type="text"
                            name="fullname"
                            class="form-control"
                            value="<?= old('fullname') ?>"
                            required>

                        <?php if (session()->getFlashdata('errors')['fullname'] ?? false): ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('errors')['fullname'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Email
                        </label>

                        <input
                            type="email"
                            name="email"
                            class="form-control"
                            value="<?= old('email') ?>"
                            required>

                        <?php if (session()->getFlashdata('errors')['email'] ?? false): ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('errors')['email'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                    <div class="mb-3">

                        <label class="form-label">
                            Course
                        </label>

                        <input
                            type="text"
                            name="course"
                            class="form-control"
                            value="<?= old('course') ?>"
                            required>

                        <?php if (session()->getFlashdata('errors')['course'] ?? false): ?>
                            <div class="text-danger">
                                <?= session()->getFlashdata('errors')['course'] ?>
                            </div>
                        <?php endif; ?>

                    </div>

                </div>

                <div class="modal-footer justify-content-center">
                    <button class="btn btn-primary px-5">
                        Save Student
                    </button>
                </div>

            </form>

        </div>

    </div>

</div>

<?= $this->endSection() ?>
<?= $this->extend('layout/main') ?>

<?= $this->section('content') ?>

<style>
    .action-btn {
        background: #3b82f6;
        border: 1px solid #3b82f6;
        color: #fff;
        transition: all .25s ease;
        transform: scale(1);
    }

    .action-btn:hover {
        background: #ffffff;
        color: #3b82f6;
        border: 1px solid #3b82f6;
        transform: translateY(-2px) scale(1.05);
        box-shadow: 0 6px 12px rgba(0, 0, 0, 0.15);
    }

    .action-btn:active {
        transform: scale(0.95);
        box-shadow: none;
    }

    .action-group .btn {
        margin-right: 4px;
    }
</style>

<h2 class="mb-4">Student Management System</h2>

<div class="row">
    <div class="col-md-4">
        <div class="card">
            <div class="card-header">Add New Student</div>
            <div class="card-body">
                <form action="/students/store" method="post">
                    <?= csrf_field() ?>
                    <input type="text" name="fullname" class="form-control mb-2" placeholder="Full Name" required>
                    <input type="email" name="email" class="form-control mb-2" placeholder="Email" required>
                    <input type="text" name="course" class="form-control mb-3" placeholder="Course" required>
                    <button class="btn btn-primary w-100">Add Student</button>
                </form>
            </div>
        </div>
    </div>

    <div class="col-md-8">
        <div class="card">
            <div class="card-header">Students</div>
            <div class="card-body">
                <table class="table table-bordered">
                    <thead class="table-dark">
                        <tr>
                            <th>No</th>
                            <th>Full Name</th>
                            <th>Email</th>
                            <th>Course</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>

                        <?php $no = 1; foreach($students as $row): ?>

                        <tr>
                            <td><?= $no++ ?></td>
                            <td><?= $row['fullname'] ?></td>
                            <td><?= $row['email'] ?></td>
                            <td><?= $row['course'] ?></td>

                            <td class="action-group">
                                <button class="btn action-btn btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#viewModal<?= $row['id'] ?>">
                                    View
                                </button>

                                <button class="btn action-btn btn-sm"
                                        data-bs-toggle="modal"
                                        data-bs-target="#editModal<?= $row['id'] ?>">
                                    Edit
                                </button>

                                <a href="/students/delete/<?= $row['id'] ?>"
                                class="btn action-btn btn-sm"
                                onclick="return confirm('Are you sure you want to delete this student?')">
                                    Delete
                                </a>
                            </td>

                        </tr>

                        <div class="modal fade" id="viewModal<?= $row['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title text-center w-100">
                                            Student Details
                                        </h5>

                                        <button type="button"
                                                class="btn-close position-absolute end-0 me-3"
                                                data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <div class="modal-body">

                                        <div class="mb-3">
                                            <label class="form-label">Full Name</label>
                                            <input type="text"
                                                class="form-control"
                                                value="<?= $row['fullname'] ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Email</label>
                                            <input type="text"
                                                class="form-control"
                                                value="<?= $row['email'] ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Course</label>
                                            <input type="text"
                                                class="form-control"
                                                value="<?= $row['course'] ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">
                                                Created Date & Time
                                            </label>

                                            <input type="text"
                                                class="form-control"
                                                value="<?= date('F d, Y • h:i A', strtotime($row['created_at'])) ?>"
                                                readonly>
                                        </div>

                                        <div class="mb-3">
                                            <label class="form-label">Last Updated</label>

                                            <input type="text"
                                                class="form-control"
                                                value="<?= $row['updated_at'] ? date('F d, Y • h:i A', strtotime($row['updated_at'])) : 'Not updated' ?>"
                                                readonly>
                                        </div>

                                    </div>

                                    <div class="modal-footer justify-content-center">
                                        <button class="btn btn-secondary"
                                                data-bs-dismiss="modal">
                                            Close
                                        </button>
                                    </div>

                                </div>
                            </div>
                        </div>

                        <div class="modal fade" id="editModal<?= $row['id'] ?>" tabindex="-1">
                            <div class="modal-dialog modal-dialog-centered">
                                <div class="modal-content">

                                    <div class="modal-header justify-content-center">
                                        <h5 class="modal-title text-center w-100">
                                            Edit Student
                                        </h5>

                                        <button type="button"
                                                class="btn-close position-absolute end-0 me-3"
                                                data-bs-dismiss="modal">
                                        </button>

                                    </div>

                                    <form method="post" action="/students/update/<?= $row['id'] ?>">

                                        <?= csrf_field() ?>

                                        <div class="modal-body">

                                            <div class="mb-3">
                                                <label class="form-label">Full Name</label>
                                                <input type="text"
                                                    name="fullname"
                                                    value="<?= $row['fullname'] ?>"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Email</label>
                                                <input type="email"
                                                    name="email"
                                                    value="<?= $row['email'] ?>"
                                                    class="form-control">
                                            </div>

                                            <div class="mb-3">
                                                <label class="form-label">Course</label>
                                                <input type="text"
                                                    name="course"
                                                    value="<?= $row['course'] ?>"
                                                    class="form-control">
                                            </div>

                                        </div>

                                        <div class="modal-footer justify-content-center">

                                            <button class="btn btn-primary px-5">
                                                Update Student
                                            </button>

                                        </div>

                                    </form>

                                </div>
                            </div>
                        </div>

                        <?php endforeach ?>

                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->endSection() ?>

<?php $__env->startSection('title'); ?>
    Editer une tâche
<?php $__env->stopSection(); ?>

<?php $__env->startSection('content'); ?>
    <div class="container mt-4">
        <h1>Modifier la tâche</h1>

        <div class="card">
            <div class="card-body">
                <form action="<?php echo e(route('tasks.update', ['task' => $task->id])); ?>" method="POST">
                    <?php echo csrf_field(); ?>
                    <?php echo method_field('PUT'); ?>

                    <div class="mb-3">
                        <label for="title" class="form-label">Titre</label>
                        <input type="text" class="form-control" id="title" name="title"
                            value="<?php echo e(old('title', $task->title)); ?>" required>
                    </div>

                    <div class="mb-3">
                        <label for="description" class="form-label">Description</label>
                        <textarea class="form-control" id="description" name="description" rows="5" required><?php echo e(old('description', $task->description)); ?></textarea>
                    </div>

                    <div class="mb-3">
                        <label for="priority" class="form-label">Priorité</label>
                        <select class="form-select" id="priority" name="priority" required>
                            <?php $__currentLoopData = $taskPriorities; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $priority): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($priority->value); ?>" <?php if($task->priority == $priority->value): echo 'selected'; endif; ?>><?php echo e($priority->label()); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <div class="mb-3">
                        <label for="status" class="form-label">Statut</label>
                        <select class="form-select" id="status" name="status" required>
                            <?php $__currentLoopData = $taskStatuses; $__env->addLoop($__currentLoopData); foreach($__currentLoopData as $status): $__env->incrementLoopIndices(); $loop = $__env->getLastLoop(); ?>
                                <option value="<?php echo e($status->value); ?>" <?php if($task->status == $status->value): echo 'selected'; endif; ?>><?php echo e($status->label()); ?>

                                </option>
                            <?php endforeach; $__env->popLoop(); $loop = $__env->getLastLoop(); ?>
                        </select>
                    </div>

                    <button type="submit" class="btn btn-success">Enregistrer</button>
                    <a href="<?php echo e(route('tasks.show', ['task' => $task->id])); ?>" class="btn btn-secondary">Annuler</a>
                </form>
            </div>
        </div>
    </div>
<?php $__env->stopSection(); ?>

<?php echo $__env->make('site.layouts.main', \Illuminate\Support\Arr::except(get_defined_vars(), ['__data', '__path']))->render(); ?><?php /**PATH C:\Users\hp\Laravel_projects\apptask\resources\views/site/pages/task/edit.blade.php ENDPATH**/ ?>
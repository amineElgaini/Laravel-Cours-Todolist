@csrf

<label for="title">Title *</label>
<input type="text" id="title" name="title" value="{{ old('title', $task->title ?? '') }}">
@error('title') <p class="field-error">{{ $message }}</p> @enderror

<label for="description">Description</label>
<textarea id="description" name="description" rows="4">{{ old('description', $task->description ?? '') }}</textarea>
@error('description') <p class="field-error">{{ $message }}</p> @enderror

<label for="category_id">Category</label>
<select id="category_id" name="category_id">
    <option value="">-- No category --</option>
    @foreach ($categories as $category)
        <option value="{{ $category->id }}"
            @selected(old('category_id', $task->category_id ?? '') == $category->id)>
            {{ $category->name }}
        </option>
    @endforeach
</select>
@error('category_id') <p class="field-error">{{ $message }}</p> @enderror

<label for="due_date">Due date</label>
<input type="date" id="due_date" name="due_date"
       value="{{ old('due_date', isset($task) && $task->due_date ? $task->due_date->format('Y-m-d') : '') }}">
@error('due_date') <p class="field-error">{{ $message }}</p> @enderror

<label for="attachment">Attachment (pdf, jpg, png, docx - max 2 MB)</label>
<input type="file" id="attachment" name="attachment">
@if (isset($task) && $task->attachment)
    <p class="muted">Current file: {{ basename($task->attachment) }}. Choose a new file to replace it.</p>
@endif
@error('attachment') <p class="field-error">{{ $message }}</p> @enderror

<button class="btn">{{ $buttonText }}</button>
<a href="{{ route('tasks.index') }}" class="btn secondary">Cancel</a>

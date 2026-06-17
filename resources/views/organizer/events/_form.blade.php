@php($event = $event ?? null)

<div class="form-control">
    <label class="label py-1" for="title"><span class="label-text font-medium">Título</span></label>
    <input type="text" id="title" name="title" value="{{ old('title', optional($event)->title) }}"
           class="input input-bordered bg-base-200/50 focus:input-primary" required>
</div>

<div class="form-control">
    <label class="label py-1" for="description"><span class="label-text font-medium">Descrição</span></label>
    <textarea id="description" name="description" rows="4"
              class="textarea textarea-bordered bg-base-200/50 focus:textarea-primary" required>{{ old('description', optional($event)->description) }}</textarea>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="form-control">
        <label class="label py-1" for="date_time"><span class="label-text font-medium">Data e hora</span></label>
        <input type="datetime-local" id="date_time" name="date_time"
               value="{{ old('date_time', $event ? $event->date_time->format('Y-m-d\TH:i') : '') }}"
               class="input input-bordered bg-base-200/50 focus:input-primary" required>
    </div>

    <div class="form-control">
        <label class="label py-1" for="location"><span class="label-text font-medium">Local</span></label>
        <input type="text" id="location" name="location" value="{{ old('location', optional($event)->location) }}"
               class="input input-bordered bg-base-200/50 focus:input-primary" required>
    </div>
</div>

<div class="grid md:grid-cols-2 gap-4">
    <div class="form-control">
        <label class="label py-1" for="capacity"><span class="label-text font-medium">Número de vagas</span></label>
        <input type="number" id="capacity" name="capacity" min="1" value="{{ old('capacity', optional($event)->capacity) }}"
               class="input input-bordered bg-base-200/50 focus:input-primary" required>
    </div>

    <div class="form-control">
        <label class="label py-1" for="category_id"><span class="label-text font-medium">Categoria</span></label>
        <select id="category_id" name="category_id" class="select select-bordered bg-base-200/50 focus:select-primary w-full" required>
            <option value="">Selecione...</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', optional($event)->category_id) == $category->id)>
                    {{ $category->name }}
                </option>
            @endforeach
        </select>
    </div>
</div>

<div class="form-control">
    <label class="label py-1" for="banner"><span class="label-text font-medium">Banner (imagem, máx. 2 MB)</span></label>
    <input type="file" id="banner" name="banner" accept="image/*"
           class="file-input file-input-bordered bg-base-200/50 w-full">
    @if($event?->banner_path)
        <img src="{{ asset('storage/'.$event->banner_path) }}" alt="Banner atual"
             class="max-h-36 rounded-xl mt-3 border border-base-content/10">
    @endif
</div>

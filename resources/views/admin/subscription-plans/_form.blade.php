<div class="row g-3">
    <div class="col-md-6">
        <label for="name" class="form-label">Plan name <span class="text-danger">*</span></label>
        <input id="name" name="name" class="form-control @error('name') is-invalid @enderror"
               value="{{ old('name', $plan->name ?? '') }}" maxlength="120" required>
        @error('name')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="price" class="form-label">Price <span class="text-danger">*</span></label>
        <input id="price" name="price" type="number" min="0" step="0.01"
               class="form-control @error('price') is-invalid @enderror"
               value="{{ old('price', $plan->price ?? '0.00') }}" required>
        @error('price')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-3">
        <label for="currency" class="form-label">Currency</label>
        <input id="currency" name="currency" class="form-control @error('currency') is-invalid @enderror"
               value="{{ old('currency', $plan->currency ?? 'CAD') }}" maxlength="3" required>
        @error('currency')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="billing_period" class="form-label">Billing period <span class="text-danger">*</span></label>
        <select id="billing_period" name="billing_period" class="form-select @error('billing_period') is-invalid @enderror" required>
            @foreach(['monthly' => 'Monthly', 'yearly' => 'Yearly', 'one_time' => 'One-time'] as $value => $label)
                <option value="{{ $value }}" @selected(old('billing_period', $plan->billing_period ?? 'monthly') === $value)>{{ $label }}</option>
            @endforeach
        </select>
        @error('billing_period')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="sort_order" class="form-label">Display order</label>
        <input id="sort_order" name="sort_order" type="number" min="0" max="100000"
               class="form-control @error('sort_order') is-invalid @enderror"
               value="{{ old('sort_order', $plan->sort_order ?? 0) }}" required>
        @error('sort_order')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label for="description" class="form-label">Description</label>
        <textarea id="description" name="description" rows="3" maxlength="2000"
                  class="form-control @error('description') is-invalid @enderror">{{ old('description', $plan->description ?? '') }}</textarea>
        @error('description')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-12">
        <label for="features_text" class="form-label">Features</label>
        <textarea id="features_text" name="features_text" rows="6"
                  class="form-control @error('features_text') is-invalid @enderror"
                  placeholder="One feature per line">{{ old('features_text', isset($plan) ? implode("\n", $plan->features ?? []) : '') }}</textarea>
        <small class="text-muted">Enter one feature per line; each is shown as a separate item on the public plans page.</small>
        @error('features_text')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6">
        <label for="is_active" class="form-label">Visibility</label>
        <select id="is_active" name="is_active" class="form-select @error('is_active') is-invalid @enderror" required>
            <option value="1" @selected((string) old('is_active', isset($plan) ? (int) $plan->is_active : 1) === '1')>Active — show publicly</option>
            <option value="0" @selected((string) old('is_active', isset($plan) ? (int) $plan->is_active : 1) === '0')>Inactive — hide publicly</option>
        </select>
        @error('is_active')<div class="invalid-feedback">{{ $message }}</div>@enderror
    </div>
    <div class="col-md-6 d-flex align-items-end">
        <div class="form-check mb-2">
            <input type="hidden" name="is_featured" value="0">
            <input id="is_featured" name="is_featured" type="checkbox" value="1" class="form-check-input"
                   @checked(old('is_featured', isset($plan) ? $plan->is_featured : false))>
            <label for="is_featured" class="form-check-label">Feature this plan on the public page</label>
        </div>
    </div>
</div>

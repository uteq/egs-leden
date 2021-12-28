<?php

namespace App\Http\Livewire;

use Illuminate\Support\Arr;
use Illuminate\Support\Str;
use Uteq\Move\Livewire\BaseResourceForm;

abstract class HeadlessResourceForm extends BaseResourceForm
{
    public $shouldRedirect = false;
    public $shouldReload = false;
    public bool $hideActions = true;

    protected $layoutVariables = [
        'sidebarMenuOpen' => false,
    ];

    public function initializeTraits()
    {
        if (method_exists(static::class, 'initialize')) {
            $this->initialize();
        }

        if (! method_exists($this, 'mount')) {
            throw new \Exception(sprintf(
                '%s: Missing mount method for %s',
                __METHOD__,
                static::class,
            ));
        }

        parent::initializeTraits();

        $this->addListener('afterSave.' . Str::slug(get_called_class()), 'afterStore');
    }

    protected function collectionClass(): ?string
    {
        // Overwrite to add your own collection class;
        return null;
    }

    public function afterStore()
    {
        foreach ($this->afterStoreHandlers() as $handler) {
            $handler($this);
        }
    }

    public function loadResourceFields()
    {
        $this->resourceFields = $this->getFormFields();

        $this->loadStore();
    }

    public function getFormFields(): array
    {
        if (!$this->collectionClass()) {
            return [];
        }

        $form = $this->collectionClass()::find($this->article->id);

        return  $form ? $form::fields() : [];
    }

    public function formFieldsData(): array
    {
        return [];
    }

    public function loadStore()
    {
        if ($this->store ?? null) {
            return $this->store;
        }

        $this->store = $this->fields()
            ->mapWithKeys(fn($field) => [$field->attribute => $field->value])
            ->toArray();

        $this->store = Arr::undot($this->store);

        return $this->store;
    }

    public function getSingleFieldStore($value, $key)
    {
        $data = Arr::get($this->store, $key, $value);
        $data = is_array($data) ? $data : [];
        Arr::set($data, $key, $value);

        return $data;
    }

    public function getSingleFieldRules($value, $key, $data)
    {
        $rules = [];
        $rules[$key] = Arr::get($this->rules($data), $key);

        return $rules;
    }

    public function validateSingleField($value, $key)
    {
        $data = $this->getSingleFieldStore($value, $key);
        $rules = $this->getSingleFieldRules($value, $key, $data);

        $this->customValidate($data, $rules);

        return $data;
    }

    public function storeSingleField($model, $value, $key, $resource = null)
    {
        $this->validateSingleField($value, $key);

        $data = [];
        Arr::set($data, Str::after($key, '.'), $value);

        $model->input = [
            'input' => array_replace_recursive($model->input->toArray(), $data)
        ];

        $model->save();

        $check = <<<HTML
            <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M5 13l4 4L19 7" />
            </svg>
        HTML;

        session()->flash('store.' . $key . '.message', $check);

        $this->message = $check;

        $this->loadResourceFields();

        parent::updatedStore($value, $key);

        $this->emit('saved');
    }

    abstract public function afterStoreHandlers();
}

<?php 

namespace App\Core;

class Validator
{
    private array $errors = [];
    private array $data = [];

    public function __construct(array $data)
    {
        $this -> data = $data;
    }

    public function required(string $field): self
    {
        if(empty(trim($this->data[$field]?? ''))){
            $this -> errors[$field][] = 'Ce champ est obligatoire';
        }

        return $this;
    }

    public function email(string $field): self
    {
        if(!filter_var($this->data[$field]?? '', FILTER_VALIDATE_EMAIL)){
            $this -> errors[$field][] = "Email invalide";
        }

        return $this;
    }

    public function min(string $field, int $length): self
    {   
        if(strlen($this->data[$field] ?? '') < $length){
            $this -> errors[$field][] = "Minimum {$length} caractères";
        }

        return $this;
    }

    public function fails(): bool
    {
        return !empty($this -> errors);
    }

    public function errors(): array
    {
        return $this -> errors;
    }

    public function validated(array $fields): array
    {
        $result = [];
        
        foreach($fields as $field){
            if(isset($this-> data[$field]) && $this ->data[$field] !== ''){
                $result[$field] = $this -> data[$field];
            }
        }
        return $result;
    }
}
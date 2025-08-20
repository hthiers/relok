<?php
/**
 * Model: UnitModel (Departamento)
 * Tabla: cas_unit
 * Relación futura: cas_task.cas_unit_id -> cas_unit.id
 */

require_once __DIR__ . '/../libs/ModelBase.php';

class UnitModel extends ModelBase
{
    /** Nombre de la tabla en la BD */
    protected static $table = 'cas_unit';

    /** Clave primaria */
    protected static $primaryKey = 'id';

    /**
     * Campos persistibles con valores por defecto.
     */
    protected static $fields = [
        'id'          => null,
        'name'        => '',
        'code'        => null,
        'description' => null,
        'is_active'   => 1,
        'created_at'  => null,
        'updated_at'  => null,
    ];

    /**
     * Validaciones mínimas
     */
    public function validate(): array
    {
        $errors = [];

        $name = $this->get('name');
        if ($name === null || trim((string)$name) === '') {
            $errors[] = 'El nombre es obligatorio.';
        } elseif (mb_strlen((string)$name) > 120) {
            $errors[] = 'El nombre no debe exceder 120 caracteres.';
        }

        $code = $this->get('code');
        if ($code !== null && mb_strlen((string)$code) > 30) {
            $errors[] = 'El código no debe exceder 30 caracteres.';
        }

        return $errors;
    }

    /** Atajos opcionales */
    public function activate(): void   { $this->set('is_active', 1); }
    public function deactivate(): void { $this->set('is_active', 0); }
}

<?php

declare(strict_types=1);

namespace Fundrik\Core\Application\Interfaces;

use Fundrik\Core\Domain\EntityId;
use Fundrik\Core\Domain\Interfaces\Entity;
use Fundrik\Core\Domain\Interfaces\EntityDto;

interface EntityServiceInterface {

	public function get_by_id( EntityId $id ): ?Entity;

	public function get_all(): array;

	public function save( EntityDto $dto ): bool;

	public function delete( EntityId $id ): bool;
}

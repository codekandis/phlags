<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationTrait;

/**
 * Represents a test fixture of a conditional manipulatable flagable.
 * @package codekandis/phlags
 * @author  Christian Ramelow <info@codekandis.net>
 */
class ConditionalManipulatablePermissions extends AbstractFlagable
{
	use ConditionalManipulationTrait;

	public const DIRECTORY = 1;

	public const UREAD     = 2;

	public const UWRITE    = 4;
}

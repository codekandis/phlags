<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationExtension;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationInterface;

/**
 * Represents a fixture of a valid conditional manipulation flagable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ValidConditionalManipulationFlagableFixture extends AbstractFlagable implements ConditionalManipulationInterface
{
	use ConditionalManipulationExtension;

	public const int FLAG_A = 1;

	public const int FLAG_B = 2;

	public const int FLAG_C = 4;
}

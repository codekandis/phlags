<?php declare( strict_types = 1 );
namespace CodeKandis\Phlags\Tests\Fixtures;

use CodeKandis\Phlags\AbstractFlagable;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationExtension;
use CodeKandis\Phlags\TraitfulExtensions\ConditionalManipulationInterface;

/**
 * Represents a test fixture of a conditional manipulatable flagable.
 * @package codekandis/phlags
 * @author Christian Ramelow <info@codekandis.net>
 */
class ConditionalManipulatableFlagable extends AbstractFlagable implements ConditionalManipulationInterface
{
	use ConditionalManipulationExtension;

	public const FLAG_A = 1;

	public const FLAG_B = 2;

	public const FLAG_C = 4;
}

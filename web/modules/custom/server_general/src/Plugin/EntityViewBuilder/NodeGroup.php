<?php

namespace Drupal\server_general\Plugin\EntityViewBuilder;

use Drupal\user\Entity\User;
use Drupal\node\NodeInterface;
use Drupal\server_general\EntityViewBuilder\NodeViewBuilderAbstract;
use Drupal\server_general\TitleAndLabelsTrait;

/**
 * The "Node Group" plugin.
 *
 * @EntityViewBuilder(
 *   id = "node.group",
 *   label = @Translation("Node - Group"),
 *   description = "Node view builder for Group bundle."
 * )
 */
class NodeGroup extends NodeViewBuilderAbstract {

  use TitleAndLabelsTrait;

  /**
   * Build full view mode.
   *
   * @param array $build
   *   The existing build.
   * @param \Drupal\node\NodeInterface $entity
   *   The entity.
   *
   * @return array
   *   Render array.
   */
  public function buildFull(array $build, NodeInterface $entity) {
    $elements = [];

    // Header.
    $element = $this->buildHeader($entity);
    $elements[] = $this->wrapContainerWide($element);

    // Greetings content.
    $element = $this->buildGreetingsMessage($entity);
    $elements[] = $this->wrapContainerWide($element);

    $elements = $this->wrapContainerVerticalSpacingBig($elements);
    $build[] = $this->wrapContainerBottomPadding($elements);

    return $build;
  }

  /**
   * Build the header.
   *
   * @param \Drupal\node\NodeInterface $entity
   *   The entity.
   *
   * @return array
   *   Render array
   *
   * @throws \IntlException
   */
  protected function buildHeader(NodeInterface $entity): array {
    $elements = [];

    $elements[] = $this->buildConditionalPageTitle($entity);

    $elements = $this->wrapContainerVerticalSpacing($elements);
    return $this->wrapContainerNarrow($elements);
  }

  /**
   * Build the Main content for Greetings.
   *
   * @param \Drupal\node\NodeInterface $entity
   *   The entity.
   *
   * @return array
   *   Render array
   *
   * @throws \IntlException
   */
  protected function buildGreetingsMessage(NodeInterface $entity): array {

    $uid = \Drupal::currentUser()->id();
    $user = User::load($uid);

    // Get the details to display on Page.
    $query = \Drupal::database()->select('og_membership', 'mt')
      ->fields('mt', ['id'])
      ->condition('mt.uid', $uid);

    $num_rows = $query->countQuery()->execute()->fetchField();

    $flag_message = FALSE;
    if ($uid > 0 && $num_rows == 0) {
      $flag_message = TRUE;
    }

    return [
      '#theme' => 'server_theme_group_node',
      '#name' => $user->getDisplayName(),
      '#label' => $entity->getTitle(),
      '#entity_id' => $entity->id(),
      '#flag_message' => $flag_message,
    ];
  }

}

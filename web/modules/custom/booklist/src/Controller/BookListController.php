<?php
/**
 * @file
 * Contains \Drupal\booklist\Controller\BookListController.
 */

namespace Drupal\booklist\Controller;

use Drupal\Core\Controller\ControllerBase;
use Drupal\node\Entity\Node;

/**
 * Controller for Book List content
 */

class BookListController extends ControllerBase {
  public function content(){
    $query = \Drupal::entityQuery('node')
      ->condition('type', 'knjiga')
      ->condition('status', 1)
      ->sort('title')
      ->execute();
    $nodes = Node::loadMultiple($query);

    $data = array();
    foreach($nodes as $node) {
      $data[] = [
        'title' => $node->get('title')->value,
        'description' => $node->get('field_opis_knjige')->value,
        'nid' => $node->get('nid')->value,
      ];
    }
    return [
      '#theme' => 'booklist',
      '#myvariable' => $data,
    ];
  }
}

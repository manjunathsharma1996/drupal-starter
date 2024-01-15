<?php

declare(strict_types=1);

namespace Drupal\server_general\ElementTrait;

/**
 * Helper methods for rendering Search/Search results related elements.
 */
trait SearchTrait {

  /**
   * Build a Search term, facets and results element.
   *
   * This is used by the Search paragraph type.
   *
   * @param array $facets_items
   *   The facets render array.
   * @param bool $has_filters
   *   Indicate if there are facet filters. That is, if a user has selected some
   *   values in one or more of the facets.
   * @param array $result_items
   *   The render array of the results.
   * @param string|null $search_term
   *   The search term if exists. Defaults to NULL.
   *
   * @return array
   *   Render array.
   */
  protected function buildElementSearchTermFacetsAndResults(array $facets_items, bool $has_filters, array $result_items, string $search_term = NULL): array {
    $elements = [];

    // Show the search term and facets if they exist.
    $element = [];
    if ($search_term) {
      $element[] = $this->buildElementSearchTermSummary($search_term);
    }

    if ($facets_items) {
      $element[] = $this->buildElementSearchFacets($facets_items, $has_filters);
    }

    $elements[] = $this->wrapContainerVerticalSpacing($element);

    // Add the results.
    $elements[] = $result_items;

    $elements = $this->wrapContainerVerticalSpacingBig($elements);
    return $this->wrapContainerWide($elements);
  }

  /**
   * Build the search summary element showing the searched term.
   *
   * @param string $search_term
   *   The searched term.
   *
   * @return array
   *   The render array for the element.
   */
  protected function buildElementSearchTermSummary(string $search_term): array {
    return [
      '#theme' => 'server_theme_search_term',
      '#search_term' => $search_term,
    ];
  }

  /**
   * Build the Search Facets element.
   *
   * @param array $facets_items
   *   The facets render array.
   * @param bool $has_filters
   *   Indicate if there are facet filters. That is, if a user has selected some
   *   values in one or more of the facets.
   *
   * @return array
   *   The render array for the element.
   */
  protected function buildElementSearchFacets($facets_items, $has_filters): array {
    return [
      '#theme' => 'server_theme_facets__search',
      '#items' => $facets_items,
      '#has_filters' => $has_filters,
    ];
  }

}

<?php

namespace App\Twig;

use Twig\TwigFilter;
use App\Twig\GlobalExtension;
use Twig\Extension\AbstractExtension;

class SortByFieldExtension extends GlobalExtension
{
    /**
     * @return array
     */
    public function getFilters()
    {
        return array(
            new TwigFilter('sortByField', array($this, 'sortByField')),
        );
    }

    public function sortByField($content, $sort_by, $direction = 'asc'){
        if (is_a($content, 'Doctrine\ORM\PersistentCollection')) {
            $content = $content->toArray();
        }
        if (!is_array($content)) {
            throw new \InvalidArgumentException('Variable passed to the sortByField filter is not an array');
        } elseif (count($content) < 1) { return $content; } else { @usort($content, function ($a, $b) use ($sort_by, $direction) { $flip = ($direction === 'desc') ? -1 : 1; if (is_array($a)) $a_sort_value = $a[$sort_by]; else if (method_exists($a, 'get' . ucfirst($sort_by))) $a_sort_value = $a->{'get' . ucfirst($sort_by)}();
                else
                    $a_sort_value = $a->$sort_by;
                if (is_array($b))
                    $b_sort_value = $b[$sort_by];
                else if (method_exists($b, 'get' . ucfirst($sort_by)))
                    $b_sort_value = $b->{'get' . ucfirst($sort_by)}();
                else
                    $b_sort_value = $b->$sort_by;
                if ($a_sort_value == $b_sort_value) {
                    return 0;
                } else if ($a_sort_value > $b_sort_value) {
                    return (1 * $flip);
                } else {
                    return (-1 * $flip);
                }
            });
        }
        return $content;
    }

    public function getName()
    {
        return 'sortbyfield_extension';
    }
}
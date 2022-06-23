<?php

namespace Drupal\brazil_holidays;

use Drupal\service_examples\HolidayProviderInterface;

class HolidayProvider implements HolidayProviderInterface
{

  /**
   * @var \Drupal\Core\Datetime\DateFormatterInterface
   */
  private $dateFormatter;

  function __construct(\Drupal\Core\Datetime\DateFormatterInterface $dateFormatter)
  {
    $this->dateFormatter = $dateFormatter;
  }

  public function getHolidays()
  {
    $current_holidays = [];

    $holiday_patterns = [
      '01-01' => "New Year's Day",
      '09-07' => "Independence Day",
      '12-25' => "Christmas",
    ];
    $current_year = $this->dateFormatter->format(REQUEST_TIME, 'custom', 'Y');

    foreach ($holiday_patterns as $date => $holiday) {
      $current_holiday_date = $current_year . '-' . $date;
      $formatted_date = $this->dateFormatter->format(strtotime($current_holiday_date));
      $current_holidays[$formatted_date] = $holiday;
    }

    return $current_holidays;
  }
}

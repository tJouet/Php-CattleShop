<?php
namespace App\Types;

enum AnimalType: string
{
    case Dog = 'dog';
    case Cat = 'cat';
    case Horse = 'horse';
    case Sheep = 'sheep';
}

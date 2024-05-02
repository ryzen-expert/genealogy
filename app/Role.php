<?php

namespace App;

enum Role: string
{
    case Administrator = 'administrator';
    case Manager = 'manager';
    case Editor = 'editor';
    case Member = 'member';
    case NewFamilyMember = 'new_family_member';
}

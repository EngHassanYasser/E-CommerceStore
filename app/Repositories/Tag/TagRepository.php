<?php
interface TagRepository
{
    public function firstOrCreate(string $name, string $slug);
}
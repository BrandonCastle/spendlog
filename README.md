# SpendLog

A simple personal expense tracker web app for my Web Technology final project. Built with PHP and MariaDB, runs on a Raspberry Pi Zero 2W.

## What is this?

SpendLog lets you log your daily expenses, assign them to categories, and see a summary of where your money is going. The whole thing runs locally on the RPi0 2W — no internet needed.

## Features

- Add / edit / delete expense entries
- Categorize expenses (food, transport, etc.)
- Simple summary of total spending per category
- Team member intro page

## Stack

- **Hardware:** Raspberry Pi Zero 2W
- **Server:** Apache2
- **Backend:** PHP (no frameworks)
- **Database:** MariaDB

## How it works

It is a standard 3-tier architecture: Browser to Apache plus PHP to MariaDB. PHP handles all the logic and page rendering. MariaDB stores the data. No JS frameworks, no CSS frameworks, just plain PHP and HTML.

## Database

The schema was designed following the process covered in class: ERD to Relational Model to 3NF to actual tables.

Main tables:
- expenses: stores each expense entry
- categories: expense categories
- members: team member info for the in-app intro page

## Status

Week 12 — repo set up, app working, docs in progress.

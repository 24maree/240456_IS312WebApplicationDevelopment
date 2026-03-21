-- ============================================
-- Author: Mareerose Possi
-- Date: 19th March 2026
-- Unit: IS312 Web Application Development
-- Description: SQL script to create FRU10 database,
--              Student and Program tables, and insert sample data.
-- ============================================

-- Create and select the database
CREATE DATABASE IF NOT EXISTS FRU10;
USE FRU10;

-- ============================================
-- Table: Program
-- Stores details about academic programs
-- ============================================
CREATE TABLE IF NOT EXISTS Program (
    ProgramCode     VARCHAR(10)  NOT NULL PRIMARY KEY,
    ProgramName     VARCHAR(100) NOT NULL,
    Duration        INT          NOT NULL COMMENT 'Duration in years',
    Department      VARCHAR(100) NOT NULL
);

-- ============================================
-- Table: Student
-- Stores details about enrolled students
-- ============================================
CREATE TABLE IF NOT EXISTS Student (
    StudentNo       VARCHAR(10)  NOT NULL PRIMARY KEY,
    Firstname       VARCHAR(50)  NOT NULL,
    Lastname        VARCHAR(50)  NOT NULL,
    Gender          VARCHAR(10)  NOT NULL,
    ContactNo       VARCHAR(20)  NOT NULL,
    ProgramCode     VARCHAR(10)  NOT NULL,
    -- Foreign key linking Student to Program
    FOREIGN KEY (ProgramCode) REFERENCES Program(ProgramCode)
);

-- ============================================
-- Sample Data: Program table
-- ============================================
INSERT INTO Program (ProgramCode, ProgramName, Duration, Department) VALUES
('BS',  'Bachelor of Science',              4, 'Department of Science'),
('IS',  'Bachelor of Information Systems',  4, 'Department of Information Systems'),
('IT',  'Bachelor of Information Technology', 4, 'Department of Information Technology'),
('CS',  'Bachelor of Computer Science',     4, 'Department of Computer Science');

-- ============================================
-- Sample Data: Student table
-- ============================================
INSERT INTO Student (StudentNo, Firstname, Lastname, Gender, ContactNo, ProgramCode) VALUES
('11111', 'James',   'Peter',  'Male',   '71717171', 'BS'),
('22222', 'Peter',   'Mark',   'Male',   '71727172', 'IS'),
('33333', 'Mary',    'John',   'Female', '71737173', 'BS'),
('44444', 'Belinda', 'Cain',   'Female', '71717271', 'IS');
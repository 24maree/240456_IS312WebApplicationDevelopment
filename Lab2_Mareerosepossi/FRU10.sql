-- Author: Mareerose Possi
-- Date: 23rd March 2026
-- Unit: IS312 Web Application Development
-- Description: SQL script to create FRU10 database with Student and Program tables
 
CREATE DATABASE IF NOT EXISTS FRU10;
USE FRU10;
 
-- Drop tables if they already exist (to avoid conflicts)
DROP TABLE IF EXISTS Student;
DROP TABLE IF EXISTS Program;
 
-- Create Program table
CREATE TABLE Program (
    ProgramCode VARCHAR(10)  NOT NULL PRIMARY KEY,
    ProgramName VARCHAR(100) NOT NULL,
    Duration    INT          NOT NULL,
    Faculty     VARCHAR(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
-- Insert sample program data
INSERT INTO Program (ProgramCode, ProgramName, Duration, Faculty) VALUES
('BS', 'Bachelor of Science',             3, 'Science & Technology'),
('IS', 'Bachelor of Information Systems', 3, 'Information Systems');
 
-- Create Student table
CREATE TABLE Student (
    StudentNo   VARCHAR(10) NOT NULL PRIMARY KEY,
    Firstname   VARCHAR(50) NOT NULL,
    Lastname    VARCHAR(50) NOT NULL,
    Gender      VARCHAR(10) NOT NULL,
    ContactNo   VARCHAR(20) NOT NULL,
    ProgramCode VARCHAR(10) NOT NULL,
    FOREIGN KEY (ProgramCode) REFERENCES Program(ProgramCode)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;
 
-- Insert sample student data
INSERT INTO Student (StudentNo, Firstname, Lastname, Gender, ContactNo, ProgramCode) VALUES
('11111', 'James',   'Peter', 'Male',   '71717171', 'BS'),
('22222', 'Peter',   'Mark',  'Male',   '71727172', 'IS'),
('33333', 'Mary',    'John',  'Female', '71737173', 'BS'),
('44444', 'Belinda', 'Cain',  'Female', '71717271', 'IS');
 

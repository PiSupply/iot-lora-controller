#!/bin/bash
#Reboot the hsot
echo 1 > /proc/sys/kernel/sysrq
echo s > /proc/sysrq-trigger
echo b > /proc/sysrq-trigger

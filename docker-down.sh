#! /bin/bash

# Stop and remove all running processes
numProcesses=$(docker ps -a -q | wc -l); if [ "$numProcesses" -gt "0" ]; then docker stop $(docker ps -a -q) && docker rm $(docker ps -a -q); fi

#  Remove exited processes
numExitedProcesses=$(docker ps -q -f 'status=exited' | wc -l); if [ "$numExitedProcesses" -gt "0" ]; then docker rm $(docker ps -q -f 'status=exited'); fi

#  Remove dangling images : http://www.projectatomic.io/blog/2015/07/what-are-docker-none-none-images/
numDanglingProcesses=$(docker images -f "dangling=true" -q | wc -l); if [ "$numDanglingProcesses" -gt "0" ]; then docker rmi $(docker images -f "dangling=true" -q); fi

#  Remove dangling volumes : http://stackoverflow.com/questions/31909979/docker-machine-no-space-left-on-device
numDanglingVolumes=$(docker volume ls -qf dangling=true | wc -l); if [ "$numDanglingVolumes" -gt "0" ]; then docker volume rm $(docker volume ls -qf dangling=true); fi


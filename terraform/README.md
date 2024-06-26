# Terraform for AWS Parkking

## Description

This terraform code will create:

- VPC
  - gateway for the vpc
- 2 Private subnets and 2 Public subnets
  - gateways for them
  - route tables for them
- ASG
  - will create 2 EC2 instances and start a third one if they are on >80% CPU usage
    - Each one of will run a ec2-setup.sh script that will start them up
  - policy for scale up and scale down
  - launch config for the EC2 instances
  - security group for the EC2 instances
    - open ports 80,22,443
- Load Balancer (ELB)
  - Listens to port 80
  - Has ports 22 and 443 open from SG
- RDS instance
  - Has port 3306 open from SG
- CodeDeploy
- S3 bucket for the .env file
## Requirements

1. **Terraform** installed on your machine
2. **AWS CLI** installed on your machine

## How to run

1. `aws configure`

2. `terraform init`

3. `terraform fmt -recursive`
4. `terraform validate`(to validate the code)
5. `terraform apply`
    1. enter all needed information
    2. enter "yes"

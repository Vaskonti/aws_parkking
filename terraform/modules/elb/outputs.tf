output "elb_security_group_id" {
  value = aws_security_group.ElbSG.id
}

output "elb_id" {
  value = aws_elb.web_elb.id
}

output "elb_name" {
  value = aws_elb.web_elb.name
}

output "elb_endpoint" {
  value = aws_elb.web_elb.dns_name
}

output "elb_sg_name" {
  value = aws_security_group.ElbSG.name
}

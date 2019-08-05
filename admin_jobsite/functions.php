<?php 

function countCandidate($conn)
{
	$query="SELECT * FROM user";
	$result= mysqli_query($conn,$query);
	$rowcount=mysqli_num_rows($result);

	return $rowcount;
}

function countVerifiedCandidate($conn)
{
	$query="SELECT * FROM user WHERE account_status='Verified'";
	$result= mysqli_query($conn,$query);
	$rowcount=mysqli_num_rows($result);

	return $rowcount;
}

function countGraduates($conn)
{
	$query="SELECT id FROM details WHERE highest_qualification='Graduate'";
	$result= mysqli_query($conn,$query);
	$rowcount=mysqli_num_rows($result);

	return $rowcount;
}

function mostPopularQualification($conn)
{
	$query="SELECT highest_qualification,COUNT(highest_qualification) AS hq FROM details GROUP BY highest_qualification ORDER BY hq DESC LIMIT 1";
	$result= mysqli_query($conn,$query);

	$row=mysqli_fetch_array($result);

	return $row["highest_qualification"];
}

function countRecruiter($conn)
{
	$query="SELECT * FROM recruiter";
	$result= mysqli_query($conn,$query);
	$rowcount=mysqli_num_rows($result);

	return $rowcount;
}

function countVerifiedRecruiter($conn)
{
	$query="SELECT * FROM recruiter WHERE account_status='Verified'";
	$result= mysqli_query($conn,$query);
	$rowcount=mysqli_num_rows($result);

	return $rowcount;
}

function mostPopularIndustry($conn)
{
	$query="SELECT industry,COUNT(industry) AS ind FROM recruiter GROUP BY industry ORDER BY industry DESC LIMIT 1";
	$result= mysqli_query($conn,$query);

	$row=mysqli_fetch_array($result);

	return $row["industry"];
}

function mostPopularCompany($conn)
{
	$query="SELECT company_name,COUNT(company_name) AS cmp FROM recruiter GROUP BY company_name ORDER BY cmp DESC LIMIT 1";
	$result= mysqli_query($conn,$query);

	$row=mysqli_fetch_array($result);

	return $row["company_name"];
}

function countJob($conn)
{
	$query="SELECT * FROM joblist";
	$result= mysqli_query($conn,$query);
	$rowcount=mysqli_num_rows($result);

	return $rowcount;
}

function mostPopularJobPosted($conn)
{
	$query="SELECT job_title,COUNT(job_title) AS title FROM joblist GROUP BY job_title ORDER BY title DESC LIMIT 1";
	$result= mysqli_query($conn,$query);

	$row=mysqli_fetch_array($result);

	return $row["job_title"];
}

function mostAppliedJob($conn)
{
	$query="SELECT joblist.job_title,COUNT(joblist.job_title) AS title FROM applications INNER JOIN joblist ON applications.job_id = joblist.job_id GROUP BY joblist.job_title ORDER BY title DESC LIMIT 1";
	$result= mysqli_query($conn,$query);

	$row=mysqli_fetch_array($result);

	return $row["job_title"];
}

function mostAppliedCompany($conn)
{
	$query="SELECT joblist.company,COUNT(joblist.company) AS title FROM applications INNER JOIN joblist ON applications.job_id = joblist.job_id GROUP BY joblist.company ORDER BY title DESC LIMIT 1";
	$result= mysqli_query($conn,$query);

	$row=mysqli_fetch_array($result);

	return $row["company"];
}





 ?>
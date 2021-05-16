<?php

declare(strict_types=1);

namespace User\Model\Table;

use Exception;
use Laminas\Crypt\Password\Bcrypt;
use Laminas\Db\Adapter\Adapter;
use Laminas\Db\ResultSet\HydratingResultSet;
use Laminas\Db\TableGateway\AbstractTableGateway;
use Laminas\Filter;
use Laminas\Hydrator\ClassMethodsHydrator;
use Laminas\I18n;
use Laminas\InputFilter;
use Laminas\Paginator\Adapter\DbSelect;
use Laminas\Paginator\Paginator;
use Laminas\Validator;
use User\Model\Entity\UserEntity;

class UsersTable extends AbstractTableGateway
{
	protected $adapter;          # adapter to use to connect to the database
	protected $table = 'oauth_users';  # our table. one we want to store data in

	public function __construct(Adapter $adapter)
	{
		$this->adapter = $adapter;
		$this->initialize();
	}

	public function deleteAccount(string $email)
	{        
        #$sqlQuery = $this->sql->update()->set(['active' => 0])->where(['email' => $email]);
		$sqlQuery = $this->sql->delete()->where(['email' => $email]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

		return $sqlStmt->execute();
	}

	public function fetchAllAccounts($paginated = false)
	{
		$sqlQuery = $this->sql->select()->join('access_roles', 'access_roles.role_id='.$this->table.'.role_id',
		     ['role_name'])
		    ->where(['active' => 1])
		    ->order('created ASC');

		if($paginated) {
			$classMethod = new ClassMethodsHydrator();
			$entity      = new UserEntity();
			$resultSet   = new HydratingResultSet($classMethod, $entity);

			$paginatorAdapter = new DbSelect(
				$sqlQuery,
				$this->adapter,
				$resultSet
			);

			$paginator = new Paginator($paginatorAdapter);

			return $paginator;
		}


		$sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler = $sqlStmt->execute();

		$classMethod = new ClassMethodsHydrator();
		$entity      = new UserEntity();
		$resultSet   = new HydratingResultSet($classMethod, $entity);

		$resultSet->initialize($handler);

		return $resultSet;
	}

	public function fetchAccountById(string $email)
	{
		$sqlQuery = $this->sql->select()
		    ->join('access_roles', 'access_roles.role_id='.$this->table.'.role_id', ['role_id', 'role_name'])
			->where(['email' => $email]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler  = $sqlStmt->execute()->current();

		if(!$handler) {
			return null;
		}

		$classMethod = new ClassMethodsHydrator();
		$entity      = new UserEntity();
		$classMethod->hydrate($handler, $entity);

		return $entity;
	}

	public function fetchAccountByEmail(string $email)
	{
		$sqlQuery = $this->sql->select()
            ->join('access_roles', 'access_roles.role_id='.$this->table.'.role_id', ['role_id', 'role_name'])
			->where(['email' => $email]);
		$sqlStmt = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler = $sqlStmt->execute()->current();

		if(!$handler) {
			return null;
		}

		$classMethod = new ClassMethodsHydrator();
		$entity      = new UserEntity();
		$classMethod->hydrate($handler, $entity);

		return $entity;
	}

	# filter and validate data from emailForm
	public function getEmailFormFilter()
	{
		# for those typing in let us view contents of this method slowly
		$inputFilter = new InputFilter\InputFilter();
		$factory = new InputFilter\Factory();

		# current email address
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'current_email',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
						//['name' => Filter\StringToLower::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 6,  
								'max' => 128,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters!',
									Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters!',
								],
							],
						],
						['name' => Validator\EmailAddress::class],
						[
							'name' => Validator\Db\RecordExists::class,
							'options' => [
								'table' => $this->table,
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);

		# new_email address field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'new_email',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
						//['name' => Filter\StringToLower::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 6,  
								'max' => 128,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters!',
									Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters!',
								],
							],
						],
						['name' => Validator\EmailAddress::class],
						[
							'name' => Validator\Db\NoRecordExists::class,
							'options' => [
								'table' => $this->table,
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);

		#confirm_new_email address field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'confirm_new_email',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
						//['name' => Filter\StringToLower::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 6,  
								'max' => 128,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters!',
									Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters!',
								],
							],
						],
						['name' => Validator\EmailAddress::class],
						[
							'name' => Validator\Db\NoRecordExists::class,
							'options' => [
								'table' => $this->table,
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
						[
							'name' => Validator\Identical::class,
							'options' => [
								'token' => 'new_email',  # field to compare against
								'messages' => [ 
									Validator\Identical::NOT_SAME => 'New Email addresses do not match!',
								],

							]
						],
					],
				]
			)
		);

		# csrf 
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'csrf',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\Csrf::class,
							'options' => [
								'messages' => [
									Validator\Csrf::NOT_SAME => 'Oops! Refill the form and try again',
								],
							],
						],
					],
				]
			)
		);

		# be sure to return the input filter
		return $inputFilter;
	}

	public function getForgotFormFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
		$factory = new InputFilter\Factory();

		# filter and validate email 
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'email',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
						['name' => Filter\StringToLower::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 6,  
								'max' => 128,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters!',
									Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters!',
								],
							],
						],
						['name' => Validator\EmailAddress::class],
						[
							'name' => Validator\Db\RecordExists::class,
							'options' => [
								'table' => $this->table,
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);

		# csrf 
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'csrf',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\Csrf::class,
							'options' => [
								'messages' => [
									Validator\Csrf::NOT_SAME => 'Oops! Refill the form and try again',
								],
							],
						],
					],
				]
			)
		);

		# be sure to return the input filter
		return $inputFilter;
	
	}

	# sanitizes our loginForm
	public function getLoginFormFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
		$factory = new InputFilter\Factory();

		# filter and validate email 
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'email',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
						//['name' => Filter\StringToLower::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 6,  
								'max' => 128,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters!',
									Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters!',
								],
							],
						],
						['name' => Validator\EmailAddress::class],
						[
							'name' => Validator\Db\RecordExists::class,
							'options' => [
								'table' => $this->table,
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);

		# filter and validate password
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Password must have at least 8 characters!',
									Validator\StringLength::TOO_LONG => 'Password must have at most 25 characters!',
								],
							],
						],
					],
				]
			)
		);

		# recall checkbox
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'recall',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
						['name' => Filter\ToInt::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						['name' => I18n\Validator\IsInt::class],
						[
							'name' => Validator\InArray::class,
							'options' => [
								'haystack' => [0, 1]
							],
						],
					],
				]
			)
		);

		# csrf 
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'csrf',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],  # removes html tags
						['name' => Filter\StringTrim::class],
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\Csrf::class,
							'options' => [
								'messages' => [
									Validator\Csrf::NOT_SAME => 'Oops! Refill the form and try again',
								],
							],
						],
					],
				]
			)
		);

		# be sure to return the input filter
		return $inputFilter;
	}

	# sanitizes our form data
	public function getCreateFormFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
		$factory = new InputFilter\Factory();

		# filter and validate username input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'first_name',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
						['name' => I18n\Filter\Alnum::class], # allows only [a-zA-Z0-9] characters
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 2,
								'max' => 255,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Username must have at least 2 characters',
									Validator\StringLength::TOO_LONG => 'Username must have at most 255 characters',
								],
							],
						], 
						[
							'name' => I18n\Validator\Alnum::class,
							'options' => [
								'messages' => [
									I18n\Validator\Alnum::NOT_ALNUM => 'Username must consist of alphanumeric characters only',
								],
							],
						],
						[
							'name' => Validator\Db\NoRecordExists::class,
							'options' => [
								'table' => $this->table, 
								'field' => 'first_name',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);


# filter and validate last_name input field
$inputFilter->add(
	$factory->createInput(
		[
			'name' => 'last_name',
			'required' => true,
			'filters' => [
				['name' => Filter\StripTags::class], # stips html tags
				['name' => Filter\StringTrim::class], # removes empty spaces
				['name' => I18n\Filter\Alnum::class], # allows only [a-zA-Z0-9] characters
			],
			'validators' => [
				['name' => Validator\NotEmpty::class],
				[
					'name' => Validator\StringLength::class,
					'options' => [
						'min' => 2,
						'max' => 255,
						'messages' => [
							Validator\StringLength::TOO_SHORT => 'first name must have at least 2 characters',
							Validator\StringLength::TOO_LONG => 'first name must have at most 255 characters',
						],
					],
				], 
				[
					'name' => I18n\Validator\Alnum::class,
					'options' => [
						'messages' => [
							I18n\Validator\Alnum::NOT_ALNUM => 'first name must consist of alphanumeric characters only',
						],
					],
				],
				[
					'name' => Validator\Db\NoRecordExists::class,
					'options' => [
						'table' => $this->table, 
						'field' => 'last_name',
						'adapter' => $this->adapter,
					],
				],
			],
		]
	)
);


		# filter and validate gender select field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'gender',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class], 
						[
							'name' => Validator\InArray::class,
							'options' => [
								'haystack' => ['F', 'H'],
							],
						],
					],
				]
			)
		);

		# filter and validate email input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'email',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class],
						['name' => Filter\StringTrim::class], 
						//['name' => Filter\StringToLower::class], comment this line out
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						['name' => Validator\EmailAddress::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 6,
								'max' => 128,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters',
									Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters',
								],
							],
						],
						[
							'name' => Validator\Db\NoRecordExists::class,
							'options' => [
								'table' => $this->table,
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);

		# filter and validate confirm_email input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'confirm_email',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
						//['name' => Filter\StringToLower::class], as well as this one
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						['name' => Validator\EmailAddress::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 6,
								'max' => 128,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Email address must have at least 6 characters',
									Validator\StringLength::TOO_LONG => 'Email address must have at most 128 characters',
								],
							],
						],
						[
							'name' => Validator\Db\NoRecordExists::class,
							'options' => [
								'table' => $this->table,
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
						[
							'name' => Validator\Identical::class,
							'options' => [
								'token' => 'email',  # field to compare against
								'messages' => [ 
									Validator\Identical::NOT_SAME => 'Email addresses do not match!',
								],
							],
						],
					],
				]
			)
		);

		# filter and validate birthday dateselect field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'birthday',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\Date::class,
							'options' => [
								'format' => 'Y-m-d',
							],
						],
					],	
				]
			)
		);		

		# filter and validate password input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Password must have at least 8 characters',
									Validator\StringLength::TOO_LONG => 'Password must have at most 25 characters',
								],
							],
						],
					],
				]
			)
		);

		# filter and validate confirm_password field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'confirm_password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class], 
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'Password must have at least 8 characters',
									Validator\StringLength::TOO_LONG => 'Password must have at most 25 characters',
								],
							],
						],
						[
							'name' => Validator\Identical::class,
							'options' => [
								'token' => 'password',
								'messages' => [
									Validator\Identical::NOT_SAME => 'Passwords do not match!',
								],
							],
						],
					],
				]
			)
		);

		# csrf field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'csrf',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\Csrf::class,
							'options' => [
								'messages' => [
									Validator\Csrf::NOT_SAME => 'Oops! Refill the form.',
								],
							],
						],
					],
				]
			)
		);

		return $inputFilter;
	}

	public function getResetFormFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
		$factory = new InputFilter\Factory();

		# filter and validate password input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'new_password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'New Password must have at least 8 characters',
									Validator\StringLength::TOO_LONG => 'New Password must have at most 25 characters',
								],
							],
						],
					],
				]
			)
		);

		# filter and validate confirm_new_password field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'confirm_new_password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class], 
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'New Password must have at least 8 characters',
									Validator\StringLength::TOO_LONG => 'New Password must have at most 25 characters',
								],
							],
						],
						[
							'name' => Validator\Identical::class,
							'options' => [
								'token' => 'new_password', 
								'messages' => [
									Validator\Identical::NOT_SAME => 'Passwords do not match!',
								],
							],
						],
					],
				]
			)
		);

		# csrf field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'csrf',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\Csrf::class,
							'options' => [
								'messages' => [
									Validator\Csrf::NOT_SAME => 'Oops! Refill the form.',
								],
							],
						],
					],
				]
			)
		);

		return $inputFilter;
	}

	public function getPasswordFormFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
		$factory = new InputFilter\Factory();

		# filter and validate current password input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'current_password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'New Password must have at least 8 characters',
									Validator\StringLength::TOO_LONG => 'New Password must have at most 25 characters',
								],
							],
						],
					],
				]
			)
		);

		#filter and validate new password input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'new_password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'New Password must have at least 8 characters',
									Validator\StringLength::TOO_LONG => 'New Password must have at most 25 characters',
								],
							],
						],
					],
				]
			)
		);

		# filter and validate confirm_new_password field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'confirm_new_password',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class], 
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 8,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'New Password must have at least 8 characters',
									Validator\StringLength::TOO_LONG => 'New Password must have at most 25 characters',
								],
							],
						],
						[
							'name' => Validator\Identical::class,
							'options' => [
								'token' => 'new_password', 
								'messages' => [
									Validator\Identical::NOT_SAME => 'Passwords do not match!',
								],
							],
						],
					],
				]
			)
		);

		# csrf field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'csrf',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\Csrf::class,
							'options' => [
								'messages' => [
									Validator\Csrf::NOT_SAME => 'Oops! Refill the form.',
								],
							],
						],
					],
				]
			)
		);

		return $inputFilter;
	}


	public function getfirstnameFormFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
		$factory = new InputFilter\Factory();

		# filter and validate current_firstname input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'current_firstname',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
						['name' => I18n\Filter\Alnum::class], # allows only [a-zA-Z0-9] characters
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 2,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'firstname must have at least 2 characters',
									Validator\StringLength::TOO_LONG => 'firstname must have at most 255 characters',
								],
							],
						], 
						[
							'name' => I18n\Validator\Alnum::class,
							'options' => [
								'messages' => [
									I18n\Validator\Alnum::NOT_ALNUM => 'firstname must consist of alphanumeric characters only',
								],
							],
						],
						[
							'name' => Validator\Db\RecordExists::class,
							'options' => [
								'table' => $this->table, 
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);

		# filter and validate firstname input field
		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'new_firstname',
					'required' => true,
					'filters' => [
						['name' => Filter\StripTags::class], # stips html tags
						['name' => Filter\StringTrim::class], # removes empty spaces
						['name' => I18n\Filter\Alnum::class], # allows only [a-zA-Z0-9] characters
					],
					'validators' => [
						['name' => Validator\NotEmpty::class],
						[
							'name' => Validator\StringLength::class,
							'options' => [
								'min' => 2,
								'max' => 25,
								'messages' => [
									Validator\StringLength::TOO_SHORT => 'firstname must have at least 2 characters',
									Validator\StringLength::TOO_LONG => 'firstname must have at most 25 characters',
								],
							],
						], 
						[
							'name' => I18n\Validator\Alnum::class,
							'options' => [
								'messages' => [
									I18n\Validator\Alnum::NOT_ALNUM => 'firstname must consist of alphanumeric characters only',
								],
							],
						],
						[
							'name' => Validator\Db\NoRecordExists::class,
							'options' => [
								'table' => $this->table, 
								'field' => 'email',
								'adapter' => $this->adapter,
							],
						],
					],
				]
			)
		);

		return $inputFilter;
	}

	public function getUploadFormFilter()
	{
		$inputFilter = new InputFilter\InputFilter();
		$factory     = new InputFilter\Factory();

		$inputFilter->add(
			$factory->createInput(
				[
					'name' => 'photo',
					'required' => true,
					# note for files we start with validators before we use filters
					'validators' => [
						['name' => Validator\NotEmpty::class],
						['name' => Validator\File\IsImage::class],
						/*[
							'name' => Validator\File\MimeType::class,
							'options' => [
								'mimeType' => 'image/png. image/jpeg, image/jpg, image/gif'
							],
						],*/ # just uncomment this one. I forgot. It always gives issues.
						[
							'name' => Validator\File\Size::class,
							'options' => [
								'min' => '3kB',
								'max' => '15MB'
							],
						],
					],
					# we can now filter
					'filters' => [
						['name' => Filter\StripTags::class],
						['name' => Filter\StringTrim::class],
						[
							'name' => Filter\File\RenameUpload::class,
							'options' => [
								'target' => DOOR . DS . 'images' . DS . 'temporary' . DS . 'pic',
								'use_upload_name' => false,
								'use_upload_extension' => true,
								'overwrite' => false,
								'randomize' => true
							]
						]
					]
				]
			)
		);
		
		return $inputFilter;
	}


	public function saveAccount(array $data)
	{
		$timeNow = date('Y-m-d H:i:s');
		//firstname, changermotdepasse, password, first_name, last_name, datechangepwd, views, created, "modified ", historiqueaccount, confirmer
		$values = [
			'first_name' => ucfirst($data['first_name']),
			'last_name' => ucfirst($data['last_name']), 
			'email'    => mb_strtolower($data['email']),
			'password' => (new Bcrypt())->create($data['password']), # encrypt/hash password
			//'birthday' => $data['birthday'],
			//'gender'   => $data['gender'],
			'role_id'  => $this->assignRoleId(),
			'created'  => $timeNow,
			'modified' => $timeNow,
			"confirmer"=>FALSE,
		];
	

		$sqlQuery = $this->sql->insert()->values($values); 
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
	try{
		$res= $sqlStmt->execute();
	}catch(Exception $e){
		die($e->getMessage());
	}
		
 
		return $res;
	}

	public function updateEmail(string $email )
	{
		$values = [
			'email' => mb_strtolower($email),
			'modified' => date('Y-m-d H:i:s')
		];

		$sqlQuery = $this->sql->update()->set($values)->where(['email' => $email]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

		return $sqlStmt->execute();
	}

	public function updatePassword(string $password, string $email)
	{
		$values = [
			'password' => (new Bcrypt())->create($password),
			'modified' => date('Y-m-d H:i:s')
		];

		$sqlQuery = $this->sql->update()->set($values)->where(['email' => $email]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

		return $sqlStmt->execute();
	}

	public function updatePhoto(string $photo, string $email)
	{
		$sqlQuery = $this->sql->update()->set(['photo' => $photo])->where(['email' => $email]);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);

		return $sqlStmt->execute();
	}

	 

	private function assignRoleId()
	{
		$sqlQuery = $this->sql->select()->where(['role_id' => 'candidat']);
		$sqlStmt  = $this->sql->prepareStatementForSqlObject($sqlQuery);
		$handler  = $sqlStmt->execute()->current();

		return (!$handler) ? 'candidat' : 'candidat';
	}
}

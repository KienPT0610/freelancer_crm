<style>
:root {
  --primary: #4e73df;
  --success: #1cc88a;
  --info: #36b9cc;
  --warning: #f6c23e;
  --danger: #e74a3b;
  --dark: #5a5c69;
  --light: #f8f9fc;
}

body {
  background-color: #f8f9fc;
  font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

.sidebar {
  min-height: 100vh;
  background: linear-gradient(to bottom, #4e73df, #224abe);
  color: white;
}

.sidebar-brand {
  height: 4.5rem;
  display: flex;
  align-items: center;
  padding-left: 1.5rem;
  font-size: 1.2rem;
  font-weight: 700;
  border-bottom: 1px solid rgba(255, 255, 255, 0.1);
}

.sidebar-brand i {
  margin-right: 0.5rem;
}

.sidebar-menu {
  padding: 1rem 0;
}

.sidebar-heading {
  font-size: 0.7rem;
  text-transform: uppercase;
  letter-spacing: 0.1rem;
  color: rgba(255, 255, 255, 0.4);
  padding: 1rem 1.5rem 0.5rem;
}

.sidebar-item {
  display: block;
  padding: 0.75rem 1.5rem;
  color: rgba(255, 255, 255, 0.8);
  text-decoration: none;
  display: flex;
  align-items: center;
  transition: all 0.2s;
}

.sidebar-item i {
  margin-right: 0.5rem;
  width: 1.25rem;
  text-align: center;
}

.sidebar-item.active {
  color: white;
  background-color: rgba(255, 255, 255, 0.1);
  font-weight: 600;
}

.sidebar-item:hover {
  color: white;
  background-color: rgba(255, 255, 255, 0.1);
}

.content-wrapper {
  padding: 1.5rem;
}

.navbar {
  background-color: white;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
  border-radius: 0.35rem;
  margin-bottom: 1.5rem;
}

.navbar .dropdown-toggle::after {
  display: none;
}

.card {
  margin-bottom: 1.5rem;
  border: none;
  border-radius: 0.35rem;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
}

.card-header {
  background-color: white;
  border-bottom: 1px solid #e3e6f0;
  padding: 0.75rem 1.25rem;
  font-weight: 700;
  color: var(--dark);
}

.info-card {
  position: relative;
  overflow: hidden;
  border-left: 0.25rem solid;
}

.info-card.primary {
  border-left-color: var(--primary);
}

.info-card.success {
  border-left-color: var(--success);
}

.info-card.info {
  border-left-color: var(--info);
}

.info-card.warning {
  border-left-color: var(--warning);
}

.info-card .card-title {
  text-transform: uppercase;
  color: #4e73df;
  font-size: 0.7rem;
  font-weight: 700;
  letter-spacing: 0.1rem;
}

.info-card.primary .card-title {
  color: var(--primary);
}

.info-card.success .card-title {
  color: var(--success);
}

.info-card.info .card-title {
  color: var(--info);
}

.info-card.warning .card-title {
  color: var(--warning);
}

.info-card .card-value {
  color: var(--dark);
  font-size: 1.5rem;
  font-weight: 700;
}

.info-card i {
  position: absolute;
  top: 50%;
  right: 1.25rem;
  transform: translateY(-50%);
  font-size: 2rem;
  color: #dddfeb;
}

.table thead th {
  background-color: #f8f9fc;
  border-top: none;
}

.badge-status {
  padding: 0.4rem 0.8rem;
  border-radius: 1rem;
  font-size: 0.7rem;
  font-weight: 600;
}

.badge-active {
  background-color: rgba(28, 200, 138, 0.1);
  color: var(--success);
}

.badge-pending {
  background-color: rgba(246, 194, 62, 0.1);
  color: var(--warning);
}

.badge-completed {
  background-color: rgba(54, 185, 204, 0.1);
  color: var(--info);
}

.badge-cancelled {
  background-color: rgba(231, 74, 59, 0.1);
  color: var(--danger);
}

.footer {
  background-color: white;
  box-shadow: 0 0.15rem 1.75rem 0 rgba(58, 59, 69, 0.15);
  border-radius: 0.35rem;
  padding: 1rem;
  text-align: center;
  font-size: 0.8rem;
  color: var(--dark);
}
</style> 